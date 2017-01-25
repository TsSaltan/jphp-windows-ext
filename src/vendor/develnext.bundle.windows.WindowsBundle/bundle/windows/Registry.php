<?php
namespace bundle\windows;

use bundle\windows\result\registryResult;
use bundle\windows\result\registryItem;
use php\lib\arr;
use php\lib\str;
use php\util\Regex;
use bundle\windows\WindowsScriptHost as WSH;


class Registry 
{
    /**
     * --RU--
     * Путь к разделу реестра
     * @var string
     */
    public $path;
    
    public function __construct($path = 'HKEY_LOCAL_MACHINE'){
        $this->path = $path;
    }
    
    /**
     * Alias __construct
     * @return Registry
     */
    public static function of($path){
        return new self($path);
    }
    
    /**
     * --RU--
     * Полное чтение содержимого раздела (ключ, значения, подразделы)
     * @param bool $recursive = false рекурсивное чтение из подазделов
     * @return array(registryResult)
     */
    public function readFully($recursive = false){
        $exec = WSH::cmd('reg query ":path"' . ($recursive ? ' /s' : ''), ['path' => $this->path]);
        return $this->parseAnswer($exec);
    }
    
    /**
     * --RU--
     * Чтение ключа
     * @param string $key имя ключа
     * @return registryItem
     */
    public function read($key){
        $exec = WSH::cmd('reg query ":path" /v ":key"', ['path' => $this->path, 'key' => $key]);
        $result = $this->parseAnswer($exec);
        return isset($result[0]) ? $result[0]->next() : null;
    }
    
    /**
     * --RU--
     * Добавить новый параметр в реестр
     * @param string $key Имя параметра
     * @param string $value Значение
     * @param string $type Тип пременной (REG_SZ|REG_DWORD|REG_BINARY)
     */
    public function add($key, $value, $type = 'REG_SZ'){   
        return WSH::cmd('reg add ":path" /v ":key" /t ":type" /d ":value" /f', [
            'path' => $this->path, 
            'key' => $key, 
            'value' => $value, 
            'type' => $type
        ]);
    }


    /**
     * --RU--
     * Создать раздел реестра
     */
    public function create(){   
        return WSH::cmd('reg add ":path" /f', ['path' => $this->path]);
    }

    /**
     * --RU--
     * Удалить раздел реестра
     */
    public function delete(){   
        return WSH::cmd('reg delete ":path" /f', ['path' => $this->path]);
    }

    /**
     * --RU--
     * Удалить содержимое раздела
     */
    public function clear(){   
        return WSH::cmd('reg delete ":path" /va /f', ['path' => $this->path]);
    }

    /**
     * --RU--
     * Удалить ключ из реестра
     * @param string $key
     */
    public function deleteKey($key){   
        return WSH::cmd('reg delete ":path" /v ":key" /f', ['path' => $this->path, 'key' => $key]);
    }

    /**
     * --RU--
     * Поиск по ключам и разделам
     * @param string $search
     * @param bool $recursive = false Искать в подразделах
     * @param bool $fullEqual = false Только полное совпадение
     * @return array[registryResult]
     */
    public function search($search, $recursive = false, $fullEqual = false){
        $exec = WSH::cmd('reg query ":path" /f ":search"' . ($fullEqual ? ' /e' : '') . ($recursive ? ' /s' : ''), ['path' => $this->path, 'search' => $search]);
        return $this->parseAnswer($exec);
    }

    /**
     * --RU--
     * Поиск по значениям
     * @param string $search
     * @param bool $recursive = false Искать в подразделах
     * @param bool $fullEqual = false Только полное совпадение
     * @return array[registryResult]
     */
    public function searchValue($search, $recursive = false, $fullEqual = false){
        $exec = WSH::cmd('reg query ":path" /f ":search" /d' . ($fullEqual ? ' /e' : '') . ($recursive ? ' /s' : ''), ['path' => $this->path, 'search' => $search]);
        return $this->parseAnswer($exec);
    }

    private function parseAnswer($answer){
        $parts = explode("\nHKEY_", $answer);      
        $return = [];
        $reg = '\n[ ]{4}([^\n]+)[ ]{4}([^\n]+)[ ]{4}([^\n\r]*)';
        
        foreach($parts as $i => $part){
            if(is_null($part)) continue;
            $regex = Regex::of($reg, Regex::CASE_INSENSITIVE + Regex::MULTILINE)->with($part);
            $path = str::lines($part)[0];
            $path = str::startsWith($path, 'HKEY_') ? $path : 'HKEY_' . $path;
            $return[$i] = new registryResult($path);
        
            while ($regex->find()){
                $return[$i]->addData($regex->group(1), $regex->group(2), Str::Trim($regex->group(3)));
            }
        }
        
        
        return $return;
    }
    
    
}
