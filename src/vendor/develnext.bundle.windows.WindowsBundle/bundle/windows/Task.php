<?php
namespace bundle\windows;

use bundle\windows\result\registryResult;
use bundle\windows\result\registryItem;
use php\lib\arr;
use php\lib\str;
use php\util\Regex;
use bundle\windows\WindowsScriptHost as WSH;


class Task 
{
    /**
     * --RU--
     * Имя процесса
     * @var string
     */
    public $name;
    
    public function __construct($name){
        $this->name = $name;
    }
    
    /**
     * 
     * @return [taskItem]
     */
    public static function getList(){
        $list = WSH::cmd('chcp 65001 | tasklist /V /FO CSV /NH', [], false, 'utf-8'); // cp изменит вывод на английский язык
        $tasks = explode("\n", $list);
        $reg = '"([^"]+)"';

        foreach ($tasks as $k=>$task) {
            $regex = Regex::of($reg, Regex::CASE_INSENSITIVE + Regex::UNICODE_CASE)->with($task);
            if ($regex->find()) {
                $return[] = $regex->all();
               /*$return[] = [
                    'name' => $regex->group(1),
                    'pid' => $regex->group(2),
                    'session' => $regex->group(3),
                    'sessionNumber' => $regex->group(4),
                    'memory' => $regex->group(5),
                    'status' => $regex->group(5),
                ];*/
            }

        }

        var_dump($return);

        //Имя образа","PID","Имя сессии","№ сеанса","Память","Состояние","Пользователь","Время ЦП","Заголовок окна"

        return $return;
    }
    

}