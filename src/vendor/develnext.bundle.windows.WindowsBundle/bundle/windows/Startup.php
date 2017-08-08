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
        $items = WSH::WMIC('startup get');
        $return = [];
        foreach($items as $k=>$item){
            $return[] = new startupItem($item['Caption'], $item['Command'], $item['Location']);

        }

        return $return;
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