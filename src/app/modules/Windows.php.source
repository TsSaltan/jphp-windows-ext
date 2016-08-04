<?php
namespace app\modules;

use php\gui\framework\AbstractModule;
use php\lang\System;
use php\lib\Str;
use php\time\Time;
use php\util\Regex;
use app\modules\windows\WSH;
use app\modules\windows\regResult;

class Windows extends AbstractModule
{
    public function __construct(){
        parent::__construct();

        if(!self::isWin()){
            alert('Внимание! Программа предназначена для работы на ОС Windows!');
        }
    }

    /**
     * --RU--
     * Проверить, относится ли текущая система к семейству OS Windows
     * @return bool
     */
    public static function isWin(){
        return Str::posIgnoreCase(System::getProperty('os.name'), 'WIN') > -1;
    }

    /**
     * --RU--
     * Получить путь ко временной папке
     * @return string
     */
    public static function getTemp(){
        return System::getEnv()['TEMP'];
    }

    /**
     * --RU--
     * Очистить временную папку
     */ 
    public static function clearTemp(){
        return WSH::execResScript('clearTemp', 'bat');
    }

    /**
     * --RU--
     * Получить массив запущенных процессов
     * @return array( [process, id, session, sessionNumber, memory], ...)
     */
    public static function getTasklist(){
        $return = [];

        $tasks = explode("\r\n", WSH::execResScript('getTasklist', 'bat'));
        $reg = '"([^"]+)","([^"]+)","([^"]+)","([^"]+)","([^"]+)"';

        foreach($tasks as $task){
            $regex = Regex::of($reg, Regex::CASE_INSENSITIVE + Regex::MULTILINE)->with($task); 
            if($regex->find()){
                $return[] = [
                    'process' => $regex->group(1),
                    'id' => $regex->group(2),
                    'session' => $regex->group(3),
                    'sessionNumber' => $regex->group(4),
                    'memory' => $regex->group(5),
                ];
            }
        }

        return $return;
    }

    /**
     * --RU--
     * Завершить процесс по его имени
     */
    public static function taskKill($procName){
        return WSH::cmd('taskkill /IM "'.$procName.'" /F');
    }

    /**
     * --RU--
     * Проверить, запущен ли процесс
     */
    public static function taskExists($procName){
        return WSH::execResScript('taskExists', 'bat', ['process' => $procName]) == '0';
    }

    /**
     * --RU--
     * Получить сериальный номер носителя
     * @param string $drive - Буква диска
     * @return string
     */
    public static function getDriveSerial($drive){
        return WSH::execResScript('getDriveSerial', 'vbs', ['drive' => $drive]);
    }

    /**
     * --RU--
     * Получить всю информацию об оперативной системе
     * @return string
     */    
    public static function getOS(){
        return WSH::WMIC('OS get')[0];
    }

    /**
     * --RU--
     * Получить всю информацию о материнской плате
     * @return string
     */    
    public static function getMotherboard(){
        return WSH::WMIC('baseboard get')[0];
    }

    /**
     * --RU--
     * Получить сериальный номер материнской платы
     * @return string
     */    
    public static function getMotherboardSerial(){
        return WSH::WMIC('baseboard get SerialNumber')[0]['SerialNumber'];
    }

    /**
     * --RU--
     * Получить производителя материнской платы
     * @return string
     */    
    public static function getMotherboardManufacturer(){
        return WSH::WMIC('baseboard get Manufacturer')[0]['Manufacturer'];
    }

    /**
     * --RU--
     * Получить модель материнской платы
     * @return string
     */    
    public static function getMotherboardProduct(){
        return WSH::WMIC('baseboard get Product')[0]['Product'];
    }

    /**
     * --RU--
     * Получить вольтаж процессора
     * @return string
     */    
    public static function getCpuVoltage(){
        return WSH::WMIC('CPU get CurrentVoltage')[0]['CurrentVoltage'];
    }

    /**
     * --RU--
     * Получить производителя процессора
     * @return string
     */    
    public static function getCpuManufacturer(){
        return WSH::WMIC('CPU get Manufacturer')[0]['Manufacturer'];
    }

    /**
     * --RU--
     * Получить частоту процессора
     * @return string
     */    
    public static function getCpuFrequency(){
        return WSH::WMIC('CPU get MaxClockSpeed')[0]['MaxClockSpeed'];
    }

    /**
     * --RU--
     * Получить серийный номер процессора
     * @return string
     */    
    public static function getCpuSerial(){
        return WSH::WMIC('CPU get ProcessorId')[0]['ProcessorId'];
    }

    /**
     * --RU--
     * Получить модель процессора
     * @return string
     */    
    public static function getCpuProduct(){
        return WSH::WMIC('CPU get Name')[0]['Name'];
    }

    /**
     * --RU--
     * Получить информацию о процессоре
     * @return string
     */    
    public static function getCPU(){
        return WSH::WMIC('CPU get')[0];
    }

    /**
     * --RU--
     * Получить модель видеокарты
     * @return string
     */    
    public static function getVideoProduct(){
        return WSH::WMIC('Path Win32_VideoController Get VideoProcessor')[0]['VideoProcessor'];
    }

    /**
     * --RU--
     * Получить производителя видеокарты
     * @return string
     */    
    public static function getVideoManufacturer(){
        return WSH::WMIC('Path Win32_VideoController Get AdapterCompatibility')[0]['AdapterCompatibility'];
    }

    /**
     * --RU--
     * Получить память видеокарты
     * @return string
     */    
    public static function getVideoRAM(){
        return WSH::WMIC('Path Win32_VideoController Get AdapterRAM')[0]['AdapterRAM'];
    }

    /**
     * --RU--
     * Получить режим (разрешение) видеокарты
     * @return string
     */    
    public static function getVideoMode(){
        return WSH::WMIC('Path Win32_VideoController Get VideoModeDescription')[0]['VideoModeDescription'];
    }

    /**
     * --RU--
     * Получить всю информацию о видеокарте
     * @return string
     */    
    public static function getVideo(){
        return WSH::WMIC('Path Win32_VideoController Get');
    }


    /**
     * --RU--
     * Получить уникальный UUID системы
     * @return string
     */ 
    public static function getUUID(){
        return WSH::execResScript('getUUID', 'vbs');
    }

    /**
     * --RU--
     * Прочитать параметр из реестра
     * @param string $path - Путь раздела
     * @param string $key - Имя параметра, по умолчанию "*" - все параметры
     * @return mixed (string - если 1 параметр, array - если несколько параметров)
     */ 
    public static function regRead($path, $key = '*'){
        $result = WSH::execScript("reg query \"{$path}\" /v \"{$key}\" > \$outPath", 'bat');

        $path = Str::Replace($path, '\\', '\\\\');
        $key = Str::Replace($key, '\\', '\\\\');

        $reg = '\n[\s]{4}([^\s]+)[\s]{4}([^\s]+)([^\n\r]*)';
        $regex = Regex::of($reg, Regex::CASE_INSENSITIVE + Regex::MULTILINE)->with($result);
        
        $return = [];

        while($regex->find()){
            $result = new regResult($regex->group(1), $regex->group(2), Str::Trim($regex->group(3)));
            if($key == '*'){
                $return[] = $result;
            }
            else return $result;
        }

        return $return;
    }

    /**
     * --RU--
     * Удалить параметр из реестра
     * @param string $path - Путь раздела
     * @param string $key - Имя параметра
     */ 
    public static function regDelete($path, $key){
        return WSH::execScript("reg delete \"{$path}\" /v \"{$key}\" /f", 'bat');
    }

    /**
     * --RU--
     * Добавить новый параметр в реестр
     * @param string $path - Путь раздела
     * @param string $key - Имя параметра
     * @param string $value - Значение
     * @param string $type - Тип пременной (REG_SZ|REG_DWORD|REG_BINARY)
     */ 
    public static function regAdd($path, $key, $value, $type = 'REG_SZ'){
        return WSH::execScript("reg add \"{$path}\" /v \"{$key}\" /t \"{$type}\" /d \"{$value}\" /f", 'bat');
    }
}