<?php
namespace bundle\windows;

use bundle\windows\result\startupItem;
use php\lib\arr;
use php\lib\str;
use php\util\Regex;
use bundle\windows\WindowsScriptHost as WSH;

/**
 * Класс содержит функции для работы с автозапуском
 */
class Startup 
{    
    /**
     * --RU--
     * Получить список программ, находящихся в автозагрузке
     * @return startupItem[]
     */
    public static function getList(){
        $wmic = self::loadWMIC();
        $registry = self::loadRegistry();
        $items = array_merge($wmic, $registry);
        $return = [];

        foreach($items as $k=>$item){
            $key = strtolower(implode('-', $item));
            $return[$key] = new startupItem($item['title'], $item['command'], $item['location']);
        }

        return array_values($return);
    }

    private static function loadWMIC(){
        $list = WSH::WMIC('startup get');
        $startup = [];
        $rShort = [
            'HKCR\\',
            'HKCU\\',
            'HKLM\\',
            'HKU\\',
            'HKCC\\',
        ];
        $rFull = [
            'HKEY_CLASSES_ROOT\\',
            'HKEY_CURRENT_USER\\',
            'HKEY_LOCAL_MACHINE\\',
            'HKEY_USERS\\',
            'HKEY_CURRENT_CONFIG\\',
        ];

        foreach($list as $v){
            $startup[] = ['title' => $v['Caption'], 'command' => $v['Command'], 'location' => str_replace($rShort, $rFull, $v['Location'])];
        }

        return $startup;
    }

    private static function loadRegistry(){
        $regPaths = [
            'HKEY_LOCAL_MACHINE\Software\Microsoft\Windows\CurrentVersion\Run',
            'HKEY_LOCAL_MACHINE\Software\Microsoft\Windows\CurrentVersion\RunOnce',
            'HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\Run',
            'HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\RunOnce',
            'HKEY_USERS\.DEFAULT\Software\Microsoft\Windows\CurrentVersion\Run',
        ];

        $startup = [];

        /*  ["title"]=>
        string(8) "OneDrive"
        ["command"]=>
        string(78) ""C:\Users\Ts.Saltan\AppData\Local\Microsoft\OneDrive\OneDrive.exe" /background"
        ["file"]=>
        string(64) "C:\Users\Ts.Saltan\AppData\Local\Microsoft\OneDrive\OneDrive.exe"
        ["shortcut"]=>
        string(94) "HKU\S-1-5-21-4010451308-21402009-2175576964-1002\SOFTWARE\Microsoft\Windows\CurrentVersion\Run"
        ["location"]=>
        string(8) "Registry"*/
        //__construct($title, $command, $location)


        foreach($regPaths as $path){
            try{
                $reg = Registry::of($path)->readFully();
                foreach($reg as $r){
                    foreach($r as $v){
                        $startup[] = ['title' => $v->key, 'command' => $v->value, 'location' => $r->path];
                    }
                }

            } catch(WindowsException $e){
            }
        }

        return $startup;
    }


    /**
     * --RU--
     * Добавляет программу в автозагрузку
     * @param string $file Команда для запуска
     * @param string $description=null Описание
     * @return startupItem
     */
    public static function add($file, $description = null){
        $dir = self::getUserStartupDirectory();
        $basename = basename($file);
        Windows::createShortcut($dir . '\\' . $basename . '.lnk', $file, $description);
        return self::find($file);
        //return new startupItem($basename, $basename . '.lnk', 'Startup');
    }

    /**
     * --RU--
     * Найти запись в автозапуске по исполняемому файлу
     * @param string $file Путь к исполняемому файлу
     * @return startupItem
     */
    public static function find($file){
        $list = self::getList();
        foreach($list as $item){
            if($item->file == $file){
                return $item;
            }
        }

        return false;
    }

    /**
     * --RU--
     * Находится ли данный файл в автозапуске
     * @param string $file Путь к исполняемому файлу
     * @return bool
     */
    public static function isExists($file){
        return self::find($file) !== false;
    }

    /**
     * --RU--
     * Возвращает путь к пользовательской папке автозагрузки
     * @return string
     */
    public static function getUserStartupDirectory(){
        return realpath(Windows::expandEnv('%APPDATA%\Microsoft\Windows\Start Menu\Programs\Startup'));
    }
    
    /**
     * --RU--
     * Возвращает путь к папке автозагрузки для программ
     * @return string
     */
    public static function getCommonStartupDirectory(){
        return realpath(Windows::expandEnv('%PROGRAMDATA%\Microsoft\Windows\Start Menu\Programs\Startup'));
    }
    
}