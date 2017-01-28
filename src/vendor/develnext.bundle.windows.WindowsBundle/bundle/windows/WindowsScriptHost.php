<?php
namespace bundle\windows;

use bundle\windows\Prepare;
use bundle\windows\WindowsException;
use bundle\windows\result\wshResult;
use php\framework\Logger;
use php\gui\framework\AbstractModule;
use php\lang\Process;
use php\lib\str;
use php\util\Regex;


class WindowsScriptHost
{
    protected static function Exec($cmd, $wait = false, $saveCache = false, $charset = 'cp1251'){
        // Logger::debug('[WSH::Exec] ' . implode(' ', $cmd));

        if($saveCache and $a = self::isCached($cmd)){
            // Logger::debug('[WSH::Exec] Read from cache');
            return $a;
        }

        $cmd = (!is_array($cmd)) ? [$cmd] : $cmd;
        
        $process = new Process($cmd);
        $process = $process->start();     

        $wshResult = new wshResult($process);
        $wshResult->setCharset($charset);
        $output = $wshResult->getOutput();

        if(strlen($output) == 0 and strlen($error = $wshResult->getError()) > 0){
            throw new WindowsException('WindowsScriptHost Error: ' . $error);
        }
        
        if($saveCache){
            // Logger::debug('[WSH::Exec] Save to cache');
            self::cache($cmd, $output);
        }
        return $output;
    }
  
    /**
     * --RU--
     * Выполнить команду
     * @param string $command
     * @param array $params Параметры для замены (в запросе можно передать именованные параметры, как в PDO)
     * @param bool $saveCache Хранить запрос в кеше
     * @param string $charset Кодировка ответа
     * @return string
     * @throws WindowsException
     */  
    public static function cmd($command, $params = [], $saveCache = false, $charset = 'cp866'){
        $command = Prepare::Query($command, $params);    
        return self::Exec(['cmd.exe', '/c', $command], true, $saveCache, $charset);  
    }
    
    /**
     * --RU--
     * Сделать запрос к WMIC
     * @param string $query
     * @param bool $saveCache Хранить запрос в кеше
     * @return array
     * @throws WindowsException
     */
    public static function WMIC($query, $saveCache = false){
        $data = self::cmd('WMIC :query /Format:List | more', ['query' => $query], $saveCache);

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
     * Выполнить скрипт PowerShell (должен располагаться в одну строку)
     * @param string $query
     * @param array $params Параметры для замены
     * @return string
     * @throws WindowsException
     */
    public static function PowerShell($query, $params = []){
        $command = Prepare::Query($query, $params); 
        return self::Exec(['powershell.exe', '-inputformat', 'none', '-command', $command], true);  
    }
    
    /**
     * --RU--
     * Выполнить скрипт vbScript (должен располагаться в одну строку)
     * @param string $query
     * @return string
     * @throws WindowsException
     */
    public static function vbScript($query){
        return self::cmd('mshta vbscript:Execute(":query")', ['query' => str::replace($query, '"', '""')]);
    }

    protected static $cacheLive = 60, // sec
                     $cached = [];
                     
    protected static function isCached($command){
        $key = str::hash(implode(' ', $command), 'MD5');

        if(array_key_exists($key, self::$cached) and self::$cached[$key]['live'] > time()){
            return self::$cached[$key]['answer'];
        } else {
            return false;
        }
    }

    protected static function cache($command, $answer){
        $command = is_array($command) ? implode(' ', $command) : $command;
        $key = str::hash($command, 'MD5');
        self::$cached[$key] = ['answer' => $answer, 'live' => (time() + self::$cacheLive)];
    }
}