<?php
namespace bundle\windows\result;

use bundle\windows\Startup;
use bundle\windows\Windows;
use bundle\windows\WindowsException;
use bundle\windows\Registry;
use php\lib\str;
use php\lib\fs;

class startupItem
{
    private $title, $command, $file, $shortcut, $location;

    public function __construct($title, $command, $location){
        $this->title = $title;
        $this->location = $location;
        $this->command = str::contains($command, '"') ? str::sub($command, 1, str::pos($command, '"', 1)) : $command;
        $this->file = realpath($this->command);

        if($location == 'Startup'){
            $this->shortcut = Startup::getUserStartupDirectory() . '\\' . $this->command;
            $this->file = Windows::getShortcutTarget($this->shortcut);
        } elseif($location == 'Common Startup'){
            $this->shortcut = Startup::getCommonStartupDirectory() . '\\' . $this->title . '.lnk';
        } elseif(str::startsWith($location, 'HK')){
            $this->shortcut = $location;
            $this->location = 'Registry';
        }
    }

    /** 
     * --RU--
     * Удалить объект из автозагрузки
     * @return bool
     */
    public function delete(){
        if($this->location == 'Registry'){
            try{
                Registry::of($this->shortcut)->deleteKey($this->title);
                return true;
            } catch (WindowsException $e){
                return false;
            }
        } else {
            return fs::delete($this->shortcut);
        }
    }

    /**
     * --RU--
     * Заголовок
     * @return string
     */
    public function title(){
        return $this->title;
    }

    /**
     * --RU--
     * Команда для запуска
     * @return string
     */
    public function command(){
        return $this->command;
    }

    /**
     * --RU--
     * Путь к исполняемому файлу
     * @return string
     */
    public function file(){
        return $this->file;
    }
    
    /**
     * --RU--
     * Расположение ярлыка для запуска
     * @return string
     */
    public function shortcut(){
        return $this->shortcut;
    }

    /**
     * --RU--
     * Расположение записи для запуска
     * @return string
     */
    public function location(){
        return $this->location;
    }

    /**
     * [title, command, file, shortcut, location].
     * @return array
     */
    public function toArray(){
        return ['title' => $this->title, 'command' => $this->command, 'file' => $this->file, 'shortcut' => $this->shortcut, 'location' => $this->location];
    }
}