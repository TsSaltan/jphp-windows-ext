<?php
namespace bundle\windows;

use bundle\windows\Windows;
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
     */
    public static function execScript($code, $type = 'js', $wait = true)
    {
        Windows::log('wsh::execScript', $code, $type);
        try {
            $tempBat = '%TEMP%\\dnBridge_' . self::getUnique() . '.bat';
            $tempOut = '%TEMP%\\dnResult_' . self::getUnique() . '.txt';
            $bat = new FileStream(self::realpath($tempBat), 'a');
            if ($type != 'bat') {
                $resPath = '.data/wsh/bridge.bat';
                $tempScr = self::realpath('%TEMP%\\dnScript_' . self::getUnique() . '.' . $type);
                $sys = new FileStream($tempScr, 'a');
                $sys->write($code);

                $stream = ResourceStream::getResources($resPath)[0];
                $data = self::replaceData($stream->readFully(), [
                    'scriptPath' => $tempScr,
                    'outPath' => $tempOut
                ]);

                $stream->close();
                $sys->close();

            } else {
                $data = self::replaceData($code, [
                    'outPath' => $tempOut
                ]);
            }

            $bat->write(Str::Encode($data, 'cp866'));
            $bat->close();
            $tempBat = self::realpath($tempBat);
            $tempOut = self::realpath($tempOut);
            self::Cmd($tempBat, $wait);
            if (!Windows::DEBUG) {
                fs::delete($tempBat);
                if (isset($tempScr)) fs::delete($tempScr);
            }
            if ($wait) {
                $result = FileStream::getContents($tempOut);
                if (!Windows::DEBUG) fs::delete($tempOut);
                return Str::Trim(Str::Decode($result, 'cp866')); // Командная строка возвращает данные в кодировке OEM 866
            }
            return null;
        } catch (\php\io\IOException $e) {
            return false;
        }
    }

    /**
     * --RU--
     * Выполнить скрипт из ресурсов программы
     */
    public static function execResScript($file, $type, $replaceParams = [], $wait = true)
    {
        Windows::log('wsh::execResScript', $file, $type, $replaceParams);
        $code = ResourceStream::getResources('.data/wsh/' . $file . '.' . $type)[0]->readFully();
        $code = self::replaceData($code, $replaceParams);
        return self::execScript($code, $type, $wait);
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

    private static function realpath($path)
    {
        return realpath(Str::Replace($path, '%TEMP%', Windows::getTemp()));
    }
}