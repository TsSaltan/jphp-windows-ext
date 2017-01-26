<?php
namespace bundle\windows;

use bundle\windows\WindowsScriptHost as WSH;
use bundle\windows\Registry;
use bundle\windows\Task;
use php\time\Time;
use php\time\TimeFormat;
use php\gui\UXApplication;
use php\lib\str;
use php\lang\System;
use php\util\Regex;
use Exception;


class Windows
{
    public static function expandEnv($string){
        $reg = '%([^%]+)%';
        $regex = Regex::of($reg, Regex::CASE_INSENSITIVE)->with($string);
        $env = System::getEnv();

        while ($regex->find()) {
            $key = $regex->group(1);
            foreach($env as $k=>$v){
                if(str::lower($k) == str::lower($key)){
                    $string = str::replace($string, $regex->group(0), $v);
                    break;
                }
            }
        }
        
        return $string;
    }
    
    /**
     * --RU--
     * Проверить, относится ли текущая система к семейству OS Windows
     * @return bool
     */
    public static function isWin()
    {
        return Str::posIgnoreCase(System::getProperty('os.name'), 'WIN') > -1;
    }
    
    /**
     * --RU--
     * Проверить, запущена ли программа от имени администратора
     * @return bool
     */
    public static function isAdmin()
    {
        try {
            (new Registry('HKU\\S-1-5-19'))->readFully();
            return true;
        } catch (WindowsException $e){
            return false;
        }
    }
    
    /**
     * Получить разрядность системы
     * @return string (x64|x86)
     */
    public static function getArch()
    {
        return isset(System::getEnv()['ProgramFiles(x86)']) ? 'x64' : 'x86'; // В 64-битных системах будет прописан путь к Program Filex (x86)
    }

    /**
     * Return system temp directory.
     * --RU--
     * Получить путь ко временной папке
     * @return string
     */
    public static function getTemp()
    {
        return self::expandEnv('%TEMP%');
    }
      
    
    /**
     * Return serial number of a drive.
     * --RU--
     * Получить сериальный номер носителя
     * @param string $drive Буква диска
     * @return string
     */
    public static function getDriveSerial($drive){
        $drive = str::endsWith($drive, ':') ? $drive : $drive . ':';
        $parts = WSH::WMIC('path Win32_LogicalDiskToPartition get', true);
        $devices = WSH::WMIC('path Win32_PhysicalMedia get', true);

        foreach($parts as $part){
            if(str::contains($part['Dependent'], '"' . $drive . '"')){
                $regex = Regex::of('DeviceID="Disk #(\d+),', Regex::CASE_INSENSITIVE + Regex::MULTILINE)->with($part['Antecedent']);
                if ($regex->find()) {
                    $nDrive = $regex->group(1);
                    foreach($devices as $device){
                        if(str::contains($device['Tag'], 'DRIVE' . $nDrive)){
                            return str::trim($device['SerialNumber']);
                        }
                    }
                }
            }
        }
    
        return null;
    }

    public static function getDrives(){
        return WSH::WMIC('path win32_logicaldisk get');
    }
    

    /**
     * Get full information of current OS.
     * --RU--
     * Получить всю информацию об оперативной системе
     * @return array
     */
    public static function getOS(){
        return WSH::WMIC('OS get', true)[0];
    }

    /**
     * Get full information of current baseboard.
     * --RU--
     * Получить всю информацию о материнской плате
     * @return string
     */
    public static function getMotherboard(){
        return WSH::WMIC('baseboard get', true)[0];
    }

    /**
     * Return serial number of current mother board.
     * --RU--
     * Получить сериальный номер материнской платы
     * @return string
     */
    public static function getMotherboardSerial(){
        return WSH::WMIC('baseboard get SerialNumber', true)[0]['SerialNumber'];
    }

    /**
     * --RU--
     * Получить производителя материнской платы
     * @return string
     */
    public static function getMotherboardManufacturer(){
        return WSH::WMIC('baseboard get Manufacturer', true)[0]['Manufacturer'];
    }

    /**
     * --RU--
     * Получить модель материнской платы
     * @return string
     */
    public static function getMotherboardProduct(){
        return WSH::WMIC('baseboard get Product', true)[0]['Product'];
    }

    /**
     * --RU--
     * Получить вольтаж процессора
     * @return string
     */
    public static function getCpuVoltage(){
        return WSH::WMIC('CPU get CurrentVoltage', true)[0]['CurrentVoltage'];
    }

    /**
     * --RU--
     * Получить производителя процессора
     * @return string
     */
    public static function getCpuManufacturer(){
        return WSH::WMIC('CPU get Manufacturer', true)[0]['Manufacturer'];
    }

    /**
     * --RU--
     * Получить частоту процессора
     * @return string
     */
    public static function getCpuFrequency(){
        return WSH::WMIC('CPU get MaxClockSpeed', true)[0]['MaxClockSpeed'];
    }

    /**
     * --RU--
     * Получить серийный номер процессора
     * @return string
     */
    public static function getCpuSerial(){
        return WSH::WMIC('CPU get ProcessorId', true)[0]['ProcessorId'];
    }

    /**
     * --RU--
     * Получить модель процессора
     * @return string
     */
    public static function getCpuProduct(){
        return WSH::WMIC('CPU get Name', true)[0]['Name'];
    }

    /**
     * --RU--
     * Получить информацию о процессоре
     * @return string
     */
    public static function getCPU(){
        return WSH::WMIC('CPU get', true)[0];
    }

    /**
     * --RU--
     * Получить модель (первой) видеокарты
     * @return string
     */
    public static function getVideoProduct(){
        return WSH::WMIC('Path Win32_VideoController Get VideoProcessor', true)[0]['VideoProcessor'];
    }

    /**
     * --RU--
     * Получить производителя (первой) видеокарты
     * @return string
     */
    public static function getVideoManufacturer(){
        return WSH::WMIC('Path Win32_VideoController Get AdapterCompatibility', true)[0]['AdapterCompatibility'];
    }

    /**
     * --RU--
     * Получить память (первой) видеокарты
     * @return string
     */
    public static function getVideoRAM(){
        return WSH::WMIC('Path Win32_VideoController Get AdapterRAM', true)[0]['AdapterRAM'];
    }

    /**
     * --RU--
     * Получить разрешение (первой) видеокарты
     * @return string
     */
    public static function getVideoMode(){
        return WSH::WMIC('Path Win32_VideoController Get VideoModeDescription', true)[0]['VideoModeDescription'];
    }

    /**
     * --RU--
     * Получить всю информацию о видеокартах
     * @return string
     */
    public static function getVideo(){
        return WSH::WMIC('Path Win32_VideoController Get', true);
    }

    /**
     * --RU--
     * Получить всю информацию о звуковых устройствах
     * @return string
     */
    public static function getSound(){
        return WSH::WMIC('Sounddev Get', true);
    }

    /**
     * --RU--
     * Получить уникальный UUID системы
     * @return string
     */
    public static function getUUID(){
        return WSH::WMIC('path win32_computersystemproduct get', true)[0]['UUID'];
        //return WSH::PowerShell('get-wmiobject Win32_ComputerSystemProduct | Select-Object -ExpandProperty UUID');
    }

    /**
     * --RU--
     * Получить ProductName системы
     * @return string
     */
    public static function getProductName(){
        return Registry::of('HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows NT\CurrentVersion')->read('ProductName')->value;
    }

    /**
     * Returns mac-address.
     * --RU--
     * Получить MAC-адрес сетевой карты
     * @return string
     */
    public static function getMAC(){
        return UXApplication::getMacAddress();
    }
    
    /**
     * --RU--
     * Получить метку времени (в миллисекундах) запуска системы
     * @return int
     */
    public static function getBootUptime(){
        $data = explode('.', WSH::WMIC('Os Get LastBootUpTime', true)[0]['LastBootUpTime'])[0];
        return (new TimeFormat('yyyyMMddHHmmss'))->parse($data)->getTime();
    }

    /**
     * --RU--
     * Получить метку времени (в миллисекундах) работы системы
     * @return int
     */
    public static function getUptime(){
        return Time::Now()->getTime() - self::getBootUptime();
    }

    /**
     * --RU--
     * Получить данные о встроенной батарее
     * @throws WindowsException
     * @return array
     */
    public static function getBatteryInfo(){
        return WSH::WMIC('Path Win32_Battery Get')[0];
    }

    /**
     * --RU--
     * Создание lnk-ярлыка (ссылки на файл)
     * @var string $shortcut Расположение ярлыка
     * @var string $target Ссылка на файл
     * @var string $description=null Описание
     * @return null
     */
    public static function createShortcut($shortcut, $target, $description = null){
        return WSH::PowerShell('$ws = New-Object -ComObject WScript.Shell; $s = $ws.CreateShortcut(\':shortcut\'); $S.TargetPath = \':target\'; $S.Description = \':description\'; $S.Save()', [
            'shortcut' => $shortcut,
            'target' => $target,
            'description' => $description
        ]);
    }

    /**
     * --RU--
     * Возвращает ссылку на файл lnk-ярлыка
     * @var string $shortcut Расположение ярлыка
     * @return string
     */
    public static function getShortcutTarget($shortcut){
        return WSH::cmd('type ":lnk"|find "\\"|findstr/b "[a-z]:[\\\\]"', ['lnk' => $shortcut]);
    }

    /**
     * --RU--
     * Проговорить текст
     * @param string $text Текст
     */
    public static function speak($text){
        return WSH::vbScript('CreateObject("SAPI.SpVoice").Speak("'.$text.'")(window.close)');
    }

}