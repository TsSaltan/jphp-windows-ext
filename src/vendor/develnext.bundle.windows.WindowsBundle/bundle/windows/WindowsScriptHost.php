<?php
namespace bundle\windows;

use bundle\windows\Windows;
use bundle\windows\WindowsException;
use php\io\ResourceStream;
use php\io\FileStream;
use php\io\File;
use php\lib\Str;
use php\lib\fs;
use php\time\Time;
use php\util\Regex;

/*
 * Windows Script Host
 * Вызов команд через оболочку Windows
 *
 * Примечание: DevelNext не совсем корректно обрабатывает кодировки отличные от UTF-8.
 * Windows использует кодировки OEM-866 и Windows-1251, и при выполнении команды 
 * напрямую через WindowsScriptHost::cmd русские символы будут преобразованы в "кракозябры", 
 * этот метод лучше вызывать, если не важны возвращаемые данные.
 * Ежели использовать WindowsScriptHost::execScript, скрипт будет вызван с использованием определенных
 * "костылей", что позволит вернуть в программу все русские символы без искажений.
 */
class WindowsScriptHost
{
    /**
     * --RU--
     * Сделать запрос к WMIC
     * @param string $query
     * @return array
     */
    public static function WMIC($query)
    {
        $data = self::execResScript('wmicQuery', 'bat', ['query' => $query]);

        $reg = '([^\n=]+)=([^\n\r]+)';
        $regex = Regex::of($reg, Regex::CASE_INSENSITIVE + Regex::MULTILINE)->with($data);

        $return = [];
        $key = 0;
        while ($regex->find()) {
            $k = $regex->group(1);
            $v = $regex->group(2);
            if (isset($return[$key][$k])) $key++;
            $return[$key][$k] = $v;
        }
        // Не возвращает [0], т.к. может быть несколько устройств, напирмер, sounddev get
        return $return;
    }

    /**
     * --RU--
     * Выполнить команду в ОС
     * @param string $cmd - Команда
     * @param bool $wait - По умолчанию true (выполнить синхронно и вернуть результат)
     * @return string
     */
    public static function cmd($cmd, $wait = true)
    {
        Windows::log('wsh::cmd', $cmd);
        if ($wait) return Str::Trim(`{$cmd}`);
        execute($cmd, false);
    }

    /**
     * --RU--
     * Выполнить JScript
     * @param string $code - Код js
     * @return bool|null|string
     */
    public static function jScript($code)
    {
        return self::execScript($code, 'js');
    }

    /**
     * --RU--
     * Выполнить VBScript
     * @param string $code - Код vbs
     * @return bool|null|string
     */
    public static function vbScript($code)
    {
        return self::execScript($code, 'vbs');
    }

    /**
     * --RU--
     * Выполнить скрипт из-под системы
     * @param string $code - Код
     * @param string $type - (bat|vbs|js)
     * @param bool $wait - true(выполнить синхронно и вернуть результат) || false (выполнить асинхронно)
     * @return bool|null|string
     * @throws WindowsException
     */
    public static function execScript($code, $type, $replace = [], $wait = true)
    {
        Windows::log('wsh::execScript', $code, $type);

        try {
            // Временные файлы: "мост", скрипт, ответ
            $tempBat = Windows::expandEnv('%TEMP%\\dnBridge_' . self::getUnique() . '.bat');
            $tempScr = Windows::expandEnv('%TEMP%\\dnScript_' . self::getUnique() . '.' . $type);
            $tempOut = Windows::expandEnv('%TEMP%\\dnResult_' . self::getUnique() . '.txt');
            
            $paths = [
                'outPath' => $tempOut,
                'scrPath' => $tempScr
            ];
            $replace = array_merge($paths, $replace);


            switch($type){
                // Скрипты js, vbs выполняем через "мост", чтоб вернуть в программу ответ
                case 'js':
                case 'jse':
                case 'vbs':
                case 'vbe':
                    $script = new FileStream($tempScr, 'a');
                    $script->write($code);
                    $script->close();
                    $code = self::getResScript('bridge', 'bat', $replace);

                case 'cmd':
                case 'bat':
                    $code = (str::contains($code, '$outPath') || str::contains($code, "\n")) ? $code : $code . ' > "$outPath"';
                    $code = self::replaceData($code, $replace);
                    $code = Str::Encode($code, 'cp866');

                    $bridge = new FileStream($tempBat, 'a');
                    $bridge->write($code);
                    $bridge->close();
                    self::cmd($tempBat, $wait);
                break;

                default:
                    throw new WindowsException('Invalid script type "'. $type .'"');
            }

            if($wait and fs::exists($tempOut)){
                $result = FileStream::getContents($tempOut);
                $result = Str::Decode($result, 'cp866'); // Командная строка возвращает данные в кодировке OEM 866
                $result = Str::Trim($result); 
            }
            else $result = NULL;
            
            if (!Windows::DEBUG) {
                // Файлы оставим только для дебага
                fs::delete($tempBat);
                fs::delete($tempScr);
                fs::delete($tempOut);
            }

            return $result;

        } catch (\php\io\IOException $e) {
            return false;
        }
    }

    /**
     * --RU--
     * Выполнить скрипт из ресурсов программы
     * @throws WindowsException
     */
    public static function execResScript($file, $type, $replaceParams = [], $wait = true)
    {
        $code = self::getResScript($file, $type, $replaceParams);
        return self::execScript($code, $type, [], $wait);
    }

    public static function getResContent($path){
        $res = ResourceStream::getResources($path);

        if(!isset($res[0]) || !is_object($res[0])){
            throw new WindowsException('Invalid resource script path "'.$path.'"');
        }

        return $res[0]->readFully();
    }

    public static function resExists($path){
        $res = ResourceStream::getResources($path);
        return (isset($res[0]) and is_object($res[0]));
    }

    private static function getResScript($file, $type, $replaceParams)
    {
        $code = self::getResContent('.data/windows/scripts/' . $file . '.' . $type);
        $code = self::replaceData($code, $replaceParams);
        
        Windows::log('wsh::getResScript', ['file' => $file, 'type' => $type, 'replaceParams' => $replaceParams, 'code' => $code]);
        return $code;
    }

    private static function getUnique()
    {
        return Time::Now()->getTime() . rand(0, 1000);
    }

    private static function replaceData($text, $array)
    {
        foreach ($array as $k => $v) {
            $text = Str::Replace($text, '$' . $k, $v);
        }
        return $text;
    }

   /* // Utilits
    public static function runUtility(){
        $cName = func_get_arg(0);

        // 1. Install
        $filename = $cName . '-' . Windows::getArch() . '.exe';
        $path = Windows::expandEnv('%TEMP%\\dnBins\\' . $filename);

        Windows::log('WSH::runUtility', ['path' => $path, 'cmd' => func_get_args()]);

        if(!fs::exists($path)){
            $res = self::getResContent('.data/windows/bins/' . $filename);
            File::of($path)->createNewFile(true);
            FileStream::putContents($path, $res);
        }

        $cmd = func_get_args();
        $cmd[0] = $path;
        return self::execScript(implode(' ', $cmd), 'bat');
    }*/
}