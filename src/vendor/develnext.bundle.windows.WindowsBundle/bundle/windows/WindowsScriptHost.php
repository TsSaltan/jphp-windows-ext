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
    protected static function Exec($cmd, $wait = false, $charset = 'cp1251'){
        //Logger::Info('[WSH::Exec] ' . implode(' ', $cmd));

        $cmd = (!is_array($cmd)) ? [$cmd] : $cmd;
        
        $process = new Process($cmd);
        $process = $process->start();     

        $wshResult = new wshResult($process);
        $wshResult->setCharset($charset);
        $output = $wshResult->getOutput();

        if(strlen($output) == 0 and strlen($error = $wshResult->getError()) > 0){
            throw new WindowsException('WindowsScriptHost Error: ' . $error);
        }
        
        return $output;
    }
  
    /**
     * --RU--
     * Выполнить команду
     * @param string $command
     * @param array $params Параметры для замены (в запросе можно передать именованные параметры, как в PDO)
     * @param string $charset Кодировка ответа
     * @return string
     * @throws WindowsException
     */  
    public static function cmd($command, $params = [], $charset = 'cp866'){
        $command = Prepare::Query($command, $params);    
        return self::Exec(['cmd.exe', '/c', $command], true, $charset);  
    }
    
    /**
     * --RU--
     * Сделать запрос к WMIC
     * @param string $query
     * @return array
     * @throws WindowsException
     */
    public static function WMIC($query){
        $data = self::cmd('WMIC :query /Format:List | more', ['query' => $query]);

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
    public static function PowerShell($query, $params = [], $wait = true){
        $command = Prepare::Query($query, $params); 
        return self::Exec(['powershell.exe', '-inputformat', 'none', '-command', $command], $wait);  
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
}