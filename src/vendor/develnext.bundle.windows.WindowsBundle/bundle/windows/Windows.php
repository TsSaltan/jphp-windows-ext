<?php
namespace bundle\windows;

use bundle\windows\reg\regResult;
use bundle\windows\util\ExeUtil;
use bundle\windows\WindowsScriptHost as WSH;
use php\lang\System;
use php\lib\fs;
use php\lib\Str;
use php\time\Time;
use php\time\TimeFormat;
use php\util\Regex;
use php\framework\Logger;
use php\gui\UXApplication;

/**
 * Class Windows
 */
class Windows
{
    const DEBUG = false;

    public static function log()
    {
        if (self::DEBUG) Logger::Debug('[Windows] ' .var_export(func_get_args(), true));
    }

    public function __construct()
    {
        if (!self::isWin()) {
            throw new WindowsException('This program should be run on OS Windows');
        }
    }

    /**
     * --RU--
     * Раскрыть переменные среды Windows 
     * (%appdata%, %temp%, etc...)
     * @param string $string
     * @return string
     */
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
        return str::length(WSH::CMD('reg query HKU\S-1-5-19')) > 0;
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
        return System::getEnv()['TEMP'];
    }

    /**
     * Return list of running tasks.
     * --RU--
     * Получить массив запущенных процессов
     * @return array( [process, id, session, sessionNumber, memory], ...)
     */
    public static function getTaskList()
    {
        $return = [];

        $tasks = explode("\r\n", WSH::execResScript('getTasklist', 'bat'));
        $reg = '"([^"]+)","([^"]+)","([^"]+)","([^"]+)","([^"]+)"';

        foreach ($tasks as $task) {
            $regex = Regex::of($reg, Regex::CASE_INSENSITIVE + Regex::MULTILINE)->with($task);
            if ($regex->find()) {
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
     * Kill a process by name.
     * --RU--
     * Завершить процесс по его имени
     */
    public static function taskKill($procName)
    {
        return WSH::cmd('taskkill /IM "' . $procName . '" /F');
    }

    /**
     * Check that process is running.
     * --RU--
     * Проверить, запущен ли процесс
     */
    public static function taskExists($procName)
    {
        return WSH::execResScript('taskExists', 'bat', ['process' => $procName]) == '0';
    }

    /**
     * Return serial number of a drive.
     * --RU--
     * Получить сериальный номер носителя
     * @param string $drive - Буква диска
     * @return string
     */
    public static function getDriveSerial($drive)
    {
        return WSH::execResScript('getDriveSerial', 'vbs', ['drive' => $drive]);
    }

    /**
     * Get full information of current OS.
     * --RU--
     * Получить всю информацию об оперативной системе
     * @return array
     */
    public static function getOS()
    {
        return WSH::WMIC('OS get')[0];
    }

    /**
     * Get full information of current baseboard.
     * --RU--
     * Получить всю информацию о материнской плате
     * @return string
     */
    public static function getMotherboard()
    {
        return WSH::WMIC('baseboard get')[0];
    }

    /**
     * Return serial number of current mother board.
     * --RU--
     * Получить сериальный номер материнской платы
     * @return string
     */
    public static function getMotherboardSerial()
    {
        return WSH::WMIC('baseboard get SerialNumber')[0]['SerialNumber'];
    }

    /**
     * --RU--
     * Получить производителя материнской платы
     * @return string
     */
    public static function getMotherboardManufacturer()
    {
        return WSH::WMIC('baseboard get Manufacturer')[0]['Manufacturer'];
    }

    /**
     * --RU--
     * Получить модель материнской платы
     * @return string
     */
    public static function getMotherboardProduct()
    {
        return WSH::WMIC('baseboard get Product')[0]['Product'];
    }

    /**
     * --RU--
     * Получить вольтаж процессора
     * @return string
     */
    public static function getCpuVoltage()
    {
        return WSH::WMIC('CPU get CurrentVoltage')[0]['CurrentVoltage'];
    }

    /**
     * --RU--
     * Получить производителя процессора
     * @return string
     */
    public static function getCpuManufacturer()
    {
        return WSH::WMIC('CPU get Manufacturer')[0]['Manufacturer'];
    }

    /**
     * --RU--
     * Получить частоту процессора
     * @return string
     */
    public static function getCpuFrequency()
    {
        return WSH::WMIC('CPU get MaxClockSpeed')[0]['MaxClockSpeed'];
    }

    /**
     * --RU--
     * Получить серийный номер процессора
     * @return string
     */
    public static function getCpuSerial()
    {
        return WSH::WMIC('CPU get ProcessorId')[0]['ProcessorId'];
    }

    /**
     * --RU--
     * Получить модель процессора
     * @return string
     */
    public static function getCpuProduct()
    {
        return WSH::WMIC('CPU get Name')[0]['Name'];
    }

    /**
     * --RU--
     * Получить информацию о процессоре
     * @return string
     */
    public static function getCPU()
    {
        return WSH::WMIC('CPU get')[0];
    }

    /**
     * --RU--
     * Получить модель (первой) видеокарты
     * @return string
     */
    public static function getVideoProduct()
    {
        return WSH::WMIC('Path Win32_VideoController Get VideoProcessor')[0]['VideoProcessor'];
    }

    /**
     * --RU--
     * Получить производителя (первой) видеокарты
     * @return string
     */
    public static function getVideoManufacturer()
    {
        return WSH::WMIC('Path Win32_VideoController Get AdapterCompatibility')[0]['AdapterCompatibility'];
    }

    /**
     * --RU--
     * Получить память (первой) видеокарты
     * @return string
     */
    public static function getVideoRAM()
    {
        return WSH::WMIC('Path Win32_VideoController Get AdapterRAM')[0]['AdapterRAM'];
    }

    /**
     * --RU--
     * Получить разрешение (первой) видеокарты
     * @return string
     */
    public static function getVideoMode()
    {
        return WSH::WMIC('Path Win32_VideoController Get VideoModeDescription')[0]['VideoModeDescription'];
    }

    /**
     * --RU--
     * Получить всю информацию о видеокартах
     * @return string
     */
    public static function getVideo()
    {
        return WSH::WMIC('Path Win32_VideoController Get');
    }

    /**
     * --RU--
     * Получить всю информацию о звуковых устройствах
     * @return string
     */
    public static function getSound()
    {
        return WSH::WMIC('Sounddev Get');
    }

    /**
     * --RU--
     * Получить уникальный UUID системы
     * @return string
     */
    public static function getUUID()
    {
        return WSH::execResScript('getUUID', 'vbs');
    }

    /**
     * Returns the activation key of current system.
     * --RU--
     * Получить ключ активации системы
     * @return string
     */
    public static function getProductKey()
    {
        return WSH::execResScript('getProductKey', 'bat');
    }

    /**
     * Returns mac-address.
     * --RU--
     * Получить MAC-адрес сетевой карты
     * @return string
     */
    public static function getMAC()
    {
        return UXApplication::getMacAddress();
        //return trim(explode(' ', WSH::CMD('getmac /fo table /NH'))[0]);
    }

    /**
     * --RU--
     * Получить список установленного ПО
     * @return array
     */
    public static function getInstalledSoftware()
    {
        $data = [];
        $list = self::regSub('HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Uninstall');
        foreach ($list as $key => $value) {
            $simple = self::regRead($value);
            $app = [];
            foreach ($simple as $v) {
                if (!in_array($v->key, ['DisplayName', 'DisplayIcon', 'Publisher', 'DisplayVersion', 'UninstallString', 'InstallLocation'])) continue;
                $app[$v->key] = $v->value;
            }
            $data[] = $app;
        }

        return $data;
    }

    /**
     * --RU--
     * Получить метку времени (в миллисекундах) запуска системы
     * @return int
     */
    public static function getBootUptime()
    {
        $data = explode('.', WSH::WMIC('Os Get LastBootUpTime')[0]['LastBootUpTime'])[0];
        return (new TimeFormat('yyyyMMddHHmmss'))->parse($data)->getTime();
    }

    /**
     * --RU--
     * Получить метку времени (в миллисекундах) работы системы
     * @return int
     */
    public static function getUptime()
    {
        return Time::Now()->getTime() - self::getBootUptime();
    }

    /**
     * --RU--
     * Получить метку времени (в миллисекундах) установки системы
     * @return int
     */
    public static function getInstallTime()
    {
        return WSH::execResScript('getInstallTimestamp', 'js') * 1000; // в DN timestamp в миллисекундах
    }

    /**
     * --RU--
     * Сканировать  подключённые к сети устройства 
     * (как в проводнике раздел "Сеть")
     * @return array(['ip' => 'host'])
     */
    public static function scanNetwork()
    {
        $return = [];
        $scan = explode("\n", WSH::execResScript('netScan', 'bat'));

        foreach($scan as $v){
            $tmp = explode(' - ', $v);
            $return[] = [
                'ip' => str::trim($tmp[0]),
                'host' => str::trim($tmp[1]),
            ];
        }

        return $return;
    }

    /**
     * --RU--
     * Прочитать параметр из реестра
     * @param string $path - Путь раздела
     * @param string $key - Имя параметра, по умолчанию "*" - все параметры
     * @return mixed (string - если 1 параметр, array - если несколько параметров)
     */
    public static function regRead($path, $key = '*')
    {
        $result = WSH::execResScript("regRead", 'bat', ['path' => $path, 'key' => $key]);

        $reg = '\n[ ]{4}([^\n]+)[ ]{4}([^\n]+)[ ]{4}([^\n\r]*)';
        $regex = Regex::of($reg, Regex::CASE_INSENSITIVE + Regex::MULTILINE)->with($result);

        $return = [];

        while ($regex->find()) {
            $result = new RegResult($regex->group(1), $regex->group(2), Str::Trim($regex->group(3)));
            if ($key == '*') {
                $return[] = $result;
            } else return $result;
        }

        return $return;
    }

    /**
     * --RU--
     * Получить подразделы
     * @param string $path - Путь раздела
     * @return array
     */
    public static function regSub($path)
    {
        $result = WSH::execScript("reg query \"{$path}\" > \$outPath", 'bat');
        return explode("\r\n", $result);
    }

    /**
     * --RU--
     * Удалить параметр из реестра
     * @param string $path - Путь раздела
     * @param string $key - Имя параметра
     * @return bool|null|string
     */
    public static function regDelete($path, $key)
    {
        return WSH::execScript("reg delete \"{$path}\" /v \"{$key}\" /f", 'bat');
    }

    /**
     * --RU--
     * Добавить новый параметр в реестр
     * @param string $path - Путь раздела
     * @param string $key - Имя параметра
     * @param string $value - Значение
     * @param string $type - Тип пременной (REG_SZ|REG_DWORD|REG_BINARY)
     * @return bool|null|string
     */
    public static function regAdd($path, $key, $value, $type = 'REG_SZ')
    {
        return WSH::execScript("reg add \"{$path}\" /v \"{$key}\" /t \"{$type}\" /d \"{$value}\" /f", 'bat');
    }

    /**
     * --RU--
     * Добавить программу в автозагрузку (нужны права администратора!)
     * @param string $path - Путь к исполняющему файлу
     * @return bool|null|string
     * @throws WindowsException
     */
    public static function startupAdd($path)
    {
        if (!fs::isFile($path)) throw new WindowsException('Invalid path "' . $path . '"');

        $path = fs::abs($path);
        return self::regAdd('HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run', $path, $path);
    }

    /**
     * --RU--
     * Удалить программу из автозагрузки
     * @param string $path - Путь к исполняющему файлу
     * @return bool|null|string
     */
    public static function startupDelete($path)
    {
        $path = fs::abs($path);
        return self::regDelete('HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run', $path);
    }

    /**
     * --RU--
     * Проверить,  находится ли программа в автозагрузке
     * @param string $path - Путь к исполняющему файлу
     * @return bool
     */
    public static function startupCheck($path)
    {
        $path = fs::abs($path);
        $check = self::regRead('HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run', $path);

        return $check->value == $path;
    }

    /**
     * --RU--
     * Получить список программ, находящихся в автозагрузке
     * @return array
     */
    public static function startupGet()
    {
        return WSH::WMIC('Startup Get');
    }

    /**
     * --RU--
     * Установить уровень громкости
     * @param double $volume - уровень громкости от 0 до 100
     */
    public static function setVolume($volume){
        $volume = ($volume >= 0 and $volume <= 100) ? $volume : 50;
        $volume = round(65535/100*$volume);
        return ExeUtil::run('nircmd', 'setsysvolume', $volume);
    }    

    /**
     * --RU--
     * Установить уровень яркости
     * (доступно на портативных устройствах: планшетах, ноутбуках)
     * @param double $brightness - уровень яркости от 0 до 100
     */
    public static function setBrightness($brightness){
        $brightness = ($brightness >= 0 and $brightness <= 100) ? $brightness : 50;
        return ExeUtil::run('nircmd', 'setbrightness', $brightness);
    }

    /**
     * --RU--
     * Очистить корзину
     */
    public static function emptyBin(){
        return ExeUtil::run('nircmd', 'emptybin');
    }

    /**
     * --RU--
     * Проговорить текст
     * @param string $text - Текст
     * @param int $rate - Скорость (-10..10, по умолчанию - 0)
     * @param int $volume - Громкость (0..100, по умолчанию - 100)
     */
    public static function speak($text, $rate = 0, $volume = 100){
        return ExeUtil::run('nircmd', 'speak text', '"'.$text.'"', $rate, $volume);
    }
}
