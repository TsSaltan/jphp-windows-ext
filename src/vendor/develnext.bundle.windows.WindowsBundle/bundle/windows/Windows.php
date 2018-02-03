<?php
namespace bundle\windows;

use bundle\windows\WindowsScriptHost as WSH;
use bundle\windows\Registry;
use bundle\windows\Task;
use Exception;
use php\gui\UXApplication;
use php\gui\UXImage;
use php\io\File;
use php\io\MiscStream;
use php\lang\System;
use php\lib\fs;
use php\lib\str;
use php\time\Time;
use php\time\TimeFormat;
use php\time\Timer;
use php\util\Regex;

/**
 * @packages windows
 */
class Windows
{
	/**
	 * Directory separator
	 * @var string
	 */
	const DS = "\\";

    /**
     * --RU--
     * Раскрывает системные переменные (%TEMP%, %APPDATA% и т.д.)
     * @param string $string
     * @return string
     * @example Windows::expandEnv('%programdata%\\Windows\\'); // string(23) "C:\ProgramData\Windows\"
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
    public static function isWin(){
        return Str::posIgnoreCase(System::getProperty('os.name'), 'WIN') > -1;
    }
    
    /**
     * --RU--
     * Проверить, запущена ли программа от имени администратора
     * @return bool
     */
    public static function isAdmin(){
        try {
            (new Registry('HKU\\S-1-5-19'))->readFully();
            return true;
        } catch (WindowsException $e){
            return false;
        }
    }

    /**
     * Запустить процесс от имени администратора
     * @param string $file
     * @param mixed $args Строка с аргументами через пробел или массив аргументов
     * @param string $dir
     */
    public static function runAsAdmin($file, $args = [], $dir = NULL){
        $args = is_array($args) ? implode(' ', $args) : $args;
        return WSH::VBScript('CreateObject("Shell.Application").ShellExecute(":file", ":args", ":dir", "runas", 1)', [
                'file' => $file,
                'args' => $args,
                'dir' => $dir
        ]);
    }

    /**
     * Перезапускает текущую программу с требованием прав администратора
     */
    public static function requireAdmin(){
        global $argv;
        if(self::isAdmin()) return;

        // Программа либо не собрана, либо библиотеки находятся отдельно от исполняемог файла,
        // а значит узнать команду запуска и путь к исполняемому файлу невозможно
        if(str::endsWith($argv[0], '/lib/jphp-core.jar')) throw new WindowsException('Cannot restart this build with administrator privileges');

        if(str::startsWith($argv[0], '/') and str::contains($argv[0], ':')){
            $argv[0] = str::sub($argv[0], 1);
        }

        switch(fs::ext($argv[0])){
            case 'exe':
                $cmd = $argv[0];
                $params = array_slice($argv, 1);
            break;

            case 'jar':
            	// если не установлена java и не прописан java_home, может быть ошибка
                $cmd = 'javaw.exe'; // javaw запускает jar без консоли
                $params = array_merge(['-jar'], $argv);
            break;

            default:
                $cmd = self::getSystem32() . 'cmd.exe';
                $params = array_merge(['/c'], $argv);

        }
       
        self::runAsAdmin($cmd, $params);
        exit;
    }
    
    /**
     * Получить разрядность системы
     * @return string 'x64' или 'x86'
     */
    public static function getArch(){
        return isset(System::getEnv()['ProgramFiles(x86)']) ? 'x64' : 'x86'; // В 64-битных системах будет прописан путь к Program Filex (x86)
    }

    /**
     * Return system temp directory.
     * --RU--
     * Получить путь ко временной папке
     * @return string
     */
    public static function getTemp(){
        return self::expandEnv('%TEMP%');
    }
      
    
    /**
     * --RU--
     * Получить список пользователей на данном ПК
     * @return array
     */
    public static function getUsers(){
        return WSH::WMIC('UserAccount get');
    }

    /**
     * Return serial number of a drive.
     * --RU--
     * Получить серийный номер носителя
     * @param string $drive Буква диска
     * @return string
     */
    public static function getDriveSerial($drive){
        $drive = str::endsWith($drive, ':') ? $drive : $drive . ':';
        $parts = WSH::WMIC('path Win32_LogicalDiskToPartition get');
        $devices = WSH::WMIC('path Win32_PhysicalMedia get');

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

    /**
     * --RU--
     * Получить список подключенных дисков и их характеристик
     * @return array Двумерный массив с характеристиками каждого подключенного диска
     */
    public static function getDrives(){
        return WSH::WMIC('path win32_logicaldisk get');
    }
    

    /**
     * Get full information of current OS.
     * --RU--
     * Получить характеристики операционной системы
     * @return array Массив с параметрами текущей операционной системы
     */
    public static function getOS(){
        return WSH::WMIC('OS get')[0];
    }

    /**
     * Get full information of current baseboard.
     * --RU--
     * Получить характеристики материнской платы
     * @return string
     */
    public static function getMotherboard(){
        return WSH::WMIC('baseboard get')[0];
    }

    /**
     * Return serial number of current mother board.
     * --RU--
     * Получить серийный номер материнской платы
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
     * Получить максимальную частоту процессора
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
     * Получить характеристики процессора
     * @return string
     */
    public static function getCPU(){
        return WSH::WMIC('CPU get')[0];
    }

    /**
     * --RU--
     * Получить модель (первой) видеокарты
     * @return string
     */
    public static function getVideoProduct(){
        return WSH::WMIC('Path Win32_VideoController Get VideoProcessor')[0]['VideoProcessor'];
    }

    /**
     * --RU--
     * Получить производителя (первой) видеокарты
     * @return string
     */
    public static function getVideoManufacturer(){
        return WSH::WMIC('Path Win32_VideoController Get AdapterCompatibility')[0]['AdapterCompatibility'];
    }

    /**
     * --RU--
     * Получить память (первой) видеокарты
     * @return string
     */
    public static function getVideoRAM(){
        return WSH::WMIC('Path Win32_VideoController Get AdapterRAM')[0]['AdapterRAM'];
    }

    /**
     * --RU--
     * Получить разрешение (первой) видеокарты
     * @return string
     */
    public static function getVideoMode(){
        return WSH::WMIC('Path Win32_VideoController Get VideoModeDescription')[0]['VideoModeDescription'];
    }

    /**
     * --RU--
     * Получить характеристики всех подключенных видеокарт
     * @return string
     */
    public static function getVideo(){
        return WSH::WMIC('Path Win32_VideoController Get');
    }

    /**
     * --RU--
     * Получить характеристики звуковых устройств
     * @return string
     */
    public static function getSound(){
        return WSH::WMIC('Sounddev Get');
    }

    /**
     * --RU--
     * Получить характеристики устройств оперативной памяти
     * @return array
     */
    public static function getRAM(){
        return WSH::WMIC('path Win32_PhysicalMemory get');
    }

    /**
     * --RU--
     * Получить полный объем оперативной памяти (в байтах)
     * @return int
     */
    public static function getTotalRAM() : int {
        return intval(WSH::WMIC('path Win32_ComputerSystem get TotalPhysicalMemory')[0]['TotalPhysicalMemory']);
    }

    /**
     * --RU--
     * Получить объем свободной оперативной памяти (в байтах)
     * @return int
     */
    public static function getFreeRAM() : int {
        return self::getOS()['FreePhysicalMemory'] * 1024;
    }

    /**
     * --RU--
     * Получить уникальный UUID системы
     * @return string
     */
    public static function getUUID(){
        return WSH::WMIC('path win32_computersystemproduct get')[0]['UUID'];
        //return WSH::PowerShell('get-wmiobject Win32_ComputerSystemProduct | Select-Object -ExpandProperty UUID');
    }

    /**
     * --RU--
     * Получить информацию о BIOS
     * @return array
     */
    public static function getBIOS(){
        return WSH::WMIC('path Win32_BIOS get')[0];
    }

    /**
     * --RU--
     * Получить массив принтеров и их характеристики
     * @return array
     * @todo add Win32_PrintJob 
     */
    public static function getPrinter(){
        return WSH::WMIC('path Win32_Printer get')[0];
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
     * Получить температуру с датчиков (желательно запускать с парвами администратора)
     * @return array ([name, temp, location])
     */
    public static function getTemperature(){
        $return = [];

        // 1. Пробуем прочитать данные с HDD
        try{
            $hdds = WSH::WMIC('/namespace:\\\\root\\WMI path MSStorageDriver_ATAPISmartData get');

            // Ищем элемент со значением 194, через 5 ключей будет элемент со значением температуры
            foreach($hdds as $hdd){
                $vs = explode(',', $hdd['VendorSpecific']);
                $tempIndex = 0;
            
                foreach ($vs as $k => $v) {
                    if(intval($v) == 194){
                        $tempIndex = $k + 5;
                        break;
                    }
                }

                // Температура в цельсиях, преобразование не нужно
                $temp = $vs[$tempIndex];
                $return[] = [
                    'name' => $hdd['InstanceName'],
                    'temp' => intval($temp),
                    'location' => 'HDD'
                ];
            }
        } catch (WindowsException $e){  }

        // 2. Данные с различных датчиков
        try{
            $msacpi = WSH::WMIC('/namespace:\\\\root\\WMI path MSAcpi_ThermalZoneTemperature get InstanceName,CurrentTemperature');
            foreach($msacpi as $v){
                if(strpos($v['InstanceName'], '\\') > 0){
                    $exp = explode('\\', $v['InstanceName']);
                    $name = end($exp);
                } else {
                    $name = $v['InstanceName'];
                }

                if(strpos($v['InstanceName'], 'CPUZ') !== false) $location = 'CPU';
                elseif(strpos($v['InstanceName'], 'GFXZ') !== false) $location = 'GFX';
                elseif(strpos($v['InstanceName'], 'BATZ') !== false) $location = 'Battery';
                elseif(strpos($name, 'TZ') === 0) $location = 'Chipset';
                else $location = 'None';
                

                $return[] = [
                    'temp' => $v['CurrentTemperature'] / 10 - 273, // Температура в Кельвинах * 10
                    'name' => $name,
                    'location' => $location,
                ];
            }
    
        } catch (WindowsException $e){  
            // 3. Данные с датчиков материрнской карты
            try{
                $temps = WSH::WMIC('/namespace:\\\\root\\cimv2 PATH Win32_PerfFormattedData_Counters_ThermalZoneInformation get Name,Temperature');

                foreach($temps as $temp){
                    if(strpos($temp['Name'], 'TZ.') > 0){
                        $name = explode('.', $temp['Name'])[1];
                        $location = 'Chipset';
                    }
                    else {
                        $name = $temp['Name'];
                        $location = 'None';
                    }

                    $return[] = [
                        'name' => $name,
                        'temp' => intval($temp['Temperature']) - 273, // Температура в Кельвинах
                        'location' => $location
                    ];    
                }
        
            } catch (WindowsException $e){  }
        }

        return $return;
    }
    
    /**
     * Количество миллисекунд с момента запуска системы
     * @var int
     */
    protected static $bootupTime;

    /**
     * --RU--
     * Получить время запуска системы
     * @return int метка времени в миллисекундах
     */
    public static function getBootUptime(){
        if(is_null(self::$bootupTime)){
            $data = explode('.', WSH::WMIC('Os Get LastBootUpTime')[0]['LastBootUpTime'])[0];
            self::$bootupTime = (new TimeFormat('yyyyMMddHHmmss'))->parse($data)->getTime();
        }
        
        return self::$bootupTime;
    }

    /**
     * --RU--
     * Получить время работы системы
     * @return int миллисекунды
     * @example $bootTime = Windows::getUptime(); 
     *          $time = new Time($bootTime, TimeZone::UTC()); 
     *          var_dump('ПК работает: ' . ($time->day() - 1) . ' дней ' . $time->hourOfDay() . ' часов ' . $time->minute() . ' минут ' . $time->second() . ' секунд'); 
     *          // string(46) "ПК работает: 0 дней 1 часов 20 минут 36 секунд"
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
        try{
            return WSH::WMIC('Path Win32_Battery Get')[0];
        } catch (\Exception $e){
            throw new WindowsException('Battery does not support');
        }
    }

    /**
     * --RU--
     * Получить предположительное оставшееся время работы.
     * @return int миллисекунды. В процессе зарядки АКБ функция может возвращать слишком большие значения
     * @throws WindowsException
     */
    public static function getBatteryTimeRemaining(){
        try{
            return intval(WSH::WMIC('Path Win32_Battery Get EstimatedRunTime')[0]['EstimatedRunTime']) * 60 * 1000;
        } catch (\Exception $e){
            throw new WindowsException('Battery does not support');
        }
    }

    /**
     * --RU--
     * Получить процент заряда батареи
     * @return int Значение от 0 до 100
     * @throws WindowsException
     */
    public static function getBatteryPercent(){
        try{
            return ++(WSH::WMIC('Path Win32_Battery Get EstimatedChargeRemaining')[0]['EstimatedChargeRemaining']);
        } catch (\Exception $e){
            throw new WindowsException('Battery does not support');
        }
    }

    /**
     * --RU--
     * Получить напряжение батареи
     * @return int милливольты
     * @throws WindowsException
     */
    public static function getBatteryVoltage(){
        try{
            return (int) WSH::WMIC('Path Win32_Battery Get DesignVoltage')[0]['DesignVoltage'];
        } catch (\Exception $e){
            throw new WindowsException('Battery does not support');
        }
    }

    /**
     * --RU--
     * Находится ли батарея на зарядке
     * @return bool
     * @throws WindowsException
     */
    public static function isBatteryCharging(){
        try{
            return ((int)WSH::WMIC('Path Win32_Battery Get BatteryStatus')[0]['BatteryStatus']) > 1;
        } catch (\Exception $e){
            throw new WindowsException('Battery does not support');
        }
    }

    /**
     * --RU--
     * Создать lnk-ярлык (ссылку на файл)
     * @param string $shortcut Расположение ярлыка
     * @param string $target Ссылка на файл
     * @param string $description=null Описание
     */
    public static function createShortcut($shortcut, $target, $description = null){
        return WSH::PowerShell('$ws = New-Object -ComObject WScript.Shell; $s = $ws.CreateShortcut(\':shortcut\'); $S.TargetPath = \':target\'; $S.Description = \':description\'; $S.Save()', [
            'shortcut' => str::replace($shortcut, "'", "\\'"),
            'target' => str::replace($target, "'", "\\'"),
            'description' => $description
        ]);
    }

    /**
     * --RU--
     * Получить ссылку на файл lnk-ярлыка
     * @param string $shortcut Расположение ярлыка
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
        return WSH::vbScript('CreateObject("SAPI.SpVoice").Speak(":text")', ['text' => $text]);
    }

    /**
     * --RU--
     * Установить уровень яркости (Windows 10 only)
     * @param int $level уровень яркости от 0 до 100
     * @param int $time=1 время в миллисекундах, за которое будет изменет уровень яркости
     * @throws WindowsException
     */
    public static function setBrightnessLevel($level, $time = 1){
        try{
            WSH::PowerShell('(Get-WmiObject -Namespace root/WMI -Class WmiMonitorBrightnessMethods).WmiSetBrightness(:time, :level)', ['time' => 1, 'level' => $level], false);
            return true;
        } catch (\Exception $e){
            throw new WindowsException('Video driver does not support changing the brightness level');
        }
    }

    /**
     * --RU--
     * Получить уровень яркости (Windows 10 only)
     * @return int уровень яркости от 0 до 100
     * @throws WindowsException
     */
    public static function getBrightnessLevel(){
        try{
            return (int) WSH::PowerShell('Get-Ciminstance -Namespace root/WMI -ClassName WmiMonitorBrightness | select -ExpandProperty CurrentBrightness');
        } catch (\Exception $e){
            throw new WindowsException('Video driver does not support changing the brightness level');
        }
    }

    /**
     * --RU--
     * Установить уровень громкости (Windows 10 only)
     * @param int $level уровень от 0 до 100
     * @throws WindowsException
     */
    public static function setVolumeLevel($level){
        return self::psAudioQuery('Volume', $level/100);     
    }

    /**
     * --RU--
     * Получить уровень громкости (Windows 10 only)
     * @return int уровень от 0 до 100
     * @throws WindowsException
     */
    public static function getVolumeLevel(){
        $vol = self::psAudioQuery('Volume');
        $vol = floatval(str_replace(',', '.', $vol));
        return (int)($vol * 100);     
    }


    /**
     * --RU--
     * Включить / выключить режим "без звука"
     * @param bool $value
     * @throws WindowsException
     */
    public static function setMute($value){
        return self::psAudioQuery('Mute', ($value ? 1 : 0));     
    }

    /**
     * --RU--
     * Проверить, включен ли режим "без звука"
     * @return bool
     * @throws WindowsException
     */
    public static function getMute(){
        return self::psAudioQuery('Mute') == 'True';     
    }

    private static $psAudioClass = <<<PS
        using System.Runtime.InteropServices;
     
        [Guid("5CDF2C82-841E-4546-9722-0CF74078229A"), InterfaceType(ComInterfaceType.InterfaceIsIUnknown)]
        interface IAudioEndpointVolume {
          int f(); int g(); int h(); int i();
          int SetMasterVolumeLevelScalar(float fLevel, System.Guid pguidEventContext);
          int j();
          int GetMasterVolumeLevelScalar(out float pfLevel);
          int k(); int l(); int m(); int n();
          int SetMute([MarshalAs(UnmanagedType.Bool)] bool bMute, System.Guid pguidEventContext);
          int GetMute(out bool pbMute);
        }
        [Guid("D666063F-1587-4E43-81F1-B948E807363F"), InterfaceType(ComInterfaceType.InterfaceIsIUnknown)]
        interface IMMDevice {
          int Activate(ref System.Guid id, int clsCtx, int activationParams, out IAudioEndpointVolume aev);
        }
        [Guid("A95664D2-9614-4F35-A746-DE8DB63617E6"), InterfaceType(ComInterfaceType.InterfaceIsIUnknown)]
        interface IMMDeviceEnumerator {
          int f(); // Unused
          int GetDefaultAudioEndpoint(int dataFlow, int role, out IMMDevice endpoint);
        }
        [ComImport, Guid("BCDE0395-E52F-467C-8E3D-C4579291692E")] class MMDeviceEnumeratorComObject { }
         
        public class Audio {
          static IAudioEndpointVolume Vol() {
            var enumerator = new MMDeviceEnumeratorComObject() as IMMDeviceEnumerator;
            IMMDevice dev = null;
            Marshal.ThrowExceptionForHR(enumerator.GetDefaultAudioEndpoint(/*eRender*/ 0, /*eMultimedia*/ 1, out dev));
            IAudioEndpointVolume epv = null;
            var epvid = typeof(IAudioEndpointVolume).GUID;
            Marshal.ThrowExceptionForHR(dev.Activate(ref epvid, /*CLSCTX_ALL*/ 23, 0, out epv));
            return epv;
          }
          public static float Volume {
            get {float v = -1; Marshal.ThrowExceptionForHR(Vol().GetMasterVolumeLevelScalar(out v)); return v;}
            set {Marshal.ThrowExceptionForHR(Vol().SetMasterVolumeLevelScalar(value, System.Guid.Empty));}
          }
          public static bool Mute {
            get { bool mute; Marshal.ThrowExceptionForHR(Vol().GetMute(out mute)); return mute; }
            set { Marshal.ThrowExceptionForHR(Vol().SetMute(value, System.Guid.Empty)); }
          }
        }
PS;

    private static function psAudioQuery($key, $value = null){          
        $params['class'] = base64_encode(str_replace(["\t", "  "], '', self::$psAudioClass));
        $params['key'] = $key;
        $params['value'] = $value;

        return WSH::PowerShell(
            '[string]$code = [System.Text.Encoding]::UTF8.GetString([System.Convert]::FromBase64String(\':class\')); '.
            'Add-Type -Language CSharpVersion3 -TypeDefinition $code; [ audio ]:::key'. (!is_null($value) ? ' = :value' : ''),
            $params
        );
    }

    /**
     * Установить системное время (нужны права администратора)
     * @param mixed $time Строка вида hh:mm:ss (напирмер, "10:20:00") или массив [10, 20, 0]
     * @throws WindowsException
     */
    public static function setTime($time){
        $time = is_array($time) ? implode(':', $time) : $time;
        if(!Regex::match('^([0-9]|[0-1][0-9]|[2][0-3]):([0-9]|[0-5][0-9]):([0-9]|[0-5][0-9])$', $time)){
            throw new WindowsException('Invalid time value "' . $time . '". Supported format: hh:mm:ss');
        }
        return WSH::CMD('echo :time | time', ['time' => $time]);
    }

    /**
     * Установить системную дату (нужны права администратора)
     * @param mixed $date Строка вида dd.MM.YYYY (напирмер, "31.12.2017") или массив [31, 12, 2017]
     */
    public static function setDate($date){
        $date = is_array($date) ? implode('.', $date) : $date;
        if(!Regex::match('^([1-9]|[0-2][0-9]|3[0-1])\.([1-9]|0[0-9]|1[0-2])\.([1-2][0-9]{3})$', $date)){
            throw new WindowsException('Invalid date value "' . $date . '". Supported format: dd.MM.YYYY');
        }
        return WSH::CMD('echo :date | date', ['date' => $date]);
    }

    /**
     * Извлекает и сохраняет отображаемую в проводнике иконку файла
     * @param string $file Файл, откуда будет извлечена иконка 
     * @param string $icon Путь для сохранения иконки, поддерживаются форматы PNG, JPG, ICO, GIF 
     */
    public static function extractIcon(string $file, string $icon) : bool {
        if(!fs::exists($file)) throw new WindowsException('File "'. $file .'" does not found');
        fs::delete($icon);
        WSH::PowerShell(
            '[System.Reflection.Assembly]::LoadWithPartialName(\'System.Drawing\'); '.
            '[System.Drawing.Icon]::ExtractAssociatedIcon(\':file\').ToBitmap().Save(\':icon\')',  
            ['file' => realpath($file), 'icon' => $icon]
        );
        
        return fs::exists($icon);
    }

    /**
     * Получить системный путь, по которому расположено изображение с обоями
     * @return string
     */
    protected static function getWallpaperPath() : string {
        $path = self::expandEnv('%AppData%\\Microsoft\\Windows\\Themes');
        foreach (File::of($path)->findFiles() as $file){
            if(str::startsWith($file->getName(), 'TranscodedWallpaper')){
                return $file->getAbsolutePath();
            }
        }

        return false;
    }      
    
    /**
     * Получить изображение с текущими обоями
     * @return UXImage
     */
    public static function getWallpaper() : UXImage {
        return new UXImage(self::getWallpaperPath());
    }    
    
    /**
     * Установить обои
     * @param string|UXImage $image
     */
    public static function setWallpaper($image){
        /** @var UXImage $image **/
        $image = $image instanceof UXImage ? $image : new UXImage($image);
        $image->save(self::getWallpaperPath(), 'jpg');
        
        // Грязный хак для обновления картинки рабочего стола
        // 100% рабочий вариант - перезапуск explorer.exe, но это занимает много времени
        for($i = 0; $i < 15; ++$i){
            Timer::setTimeout(function(){
                $upd = self::getSystem32() . 'RUNDLL32.EXE USER32.DLL,UpdatePerUserSystemParameters ,2 ,True';
                WSH::cmd($upd); 
            }, 1500 * $i);
        }
    }

    /**
     * Путь к системной папке windows\system32
     * @return string
     */
    public static function getSystem32() : string {
    	return ($_ENV['SystemRoot'] ?? 'C:\\Windows') . '\\System32\\';
    }
}