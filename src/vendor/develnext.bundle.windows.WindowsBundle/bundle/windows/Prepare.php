<?php
namespace bundle\windows;

use php\util\Regex;
use php\lib\str;


class Prepare
{
    const STRING = 'STRING',
          INTEGER = 'INTEGER',
          INT = 'INTEGER',
          FLOAT = 'FLOAT',
          BOOLEAN = 'BOOLEAN',
          BOOL = 'BOOLEAN';
          
    private $source, 
            $vars = [], // 'key' => 'value'
            $safeQuery;
            
    public $addStringQuotes = false,
           $replaceEmpty = false;

    public function __construct($query){
        $this->source = $query;
    }
    
    public function bind($key, $value, $type = 'STRING'){
        $key = (str::sub($key, 0, 1) == ':') ? str::sub($key, 1) : $key;
        $key = str::lower($key);
        
        switch($type){
            case self::STRING:
                $value = strval($value);                
                $value = str::replace($value, "\\", "\\\\");
                
                if($this->addStringQuotes === true){
                    $value = str::replace($value, "\"", "\\\"");
                    $this->vars[$key] = '"' . $value . '"';
                }
                else $this->vars[$key] = $value;
            break;            
            
            case self::INTEGER:
                $this->vars[$key] = intval($value);
            break;       
            
            case self::FLOAT:
                $this->vars[$key] = floatval($value);
            break;  
            
            case self::BOOLEAN:
                $this->vars[$key] = boolval($value);
            break;
        }
    }
    
    public function getQuery($bindParams = []){
        foreach($bindParams as $key => $value){
            $this->bind($key, $value);
        }
        
        $reg = Regex::of(':([\w\d_]+)', Regex::UNICODE_CASE | Regex::CASE_INSENSITIVE | Regex::MULTILINE)->with($this->source);
        return $reg->replaceWithCallback(function($reg){
            $key = str::lower($reg->group(1));
   
            if(isset($this->vars[$key])){
                return $this->vars[$key];
            }
            
            if($this->replaceEmpty === true){
                return 'NULL';
            }   
            else return $reg->group(0);
        });
    }
    
    public static function Query($query, $params = []){
        return (new self($query))->getQuery($params);
    }
}