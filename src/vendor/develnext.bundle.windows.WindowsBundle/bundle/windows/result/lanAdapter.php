<?php
namespace bundle\windows\result;

use bundle\windows\WindowsException;
use bundle\windows\Windows;
use php\io\File;
use php\lib\fs;
use php\lib\str;
use php\util\Regex;
use bundle\windows\WindowsScriptHost as WSH;
use php\gui\UXApplication;

class lanAdapter 
{
    private $name;
    private $device;
    private $params;
    private $ipv4;
    private $ipv6;
    private $mac;
    
    public function __construct(string $name, array $params){
    
        $this->name = $name;
        $this->params = $params;

        $this->device = $params['Description'] ?? null;
        $this->ipv4 = isset($params['IPv4 Address']) ? str_replace('(Preferred)', '', $params['IPv4 Address']) : null;
        $this->ipv6 = str_replace('(Preferred)', '', ($params['IPv6 Address'] ?? $params['Link-local IPv6 Address'] ?? null));

        $this->mac = $params['Physical Address'] ?? null;

    }
    
    /**
     * Получить имя адаптера
     */
    public function getName() : string {
        return $this->name;
    }    

    /**
     * Получить параметры адаптера
     */
    public function getParams() : array {
        return $this->params;
    }    
        
    /**
     * Получить описание устройства
     */
    public function getDevice() : string {
        return $this->device;
    }    
        
    /**
     * Получить mac адрес
     */
    public function getMac() : string {
        return $this->mac;
    }      

    /**
     * Получить IPv4 адрес
     */
    public function getIPv4() : string {
        return $this->ipv4;
    }  

    /**
     * Получить IPv6 адрес
     */
    public function getIPv6() : string {
        return $this->ipv6;
    }     

    /**
     * Используется ли сеть в данный момент
     */
    public function isActive() : bool {
        return isset($this->params['Lease Obtained']) || isset($this->params['DNS Servers']);
    }     

/******************/
    /**
     * Отключить адаптер (нужны права администратора)
     */
    public function disable(){
        WSH::cmd('netsh interface set interface name=":adapter" admin=disabled', ['adapter' => $this->name]);
    }    
        
    /**
     * Включить интерфейс (нужны права администратора)
     */
    public function enable(){
        WSH::cmd('netsh interface set interface name=":adapter" admin=enabled', ['adapter' => $this->name]);
    }   
}