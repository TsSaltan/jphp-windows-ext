<?php
namespace app\modules;

use php\lib\str;
use php\lang\System;
use php\framework\Logger;
use php\lib\fs;
use php\gui\framework\AbstractModule;
use php\gui\framework\ScriptEvent; 

use bundle\windows\Windows;


class AppModule extends AbstractModule
{

    /**
     * @event action 
     */
    function doAction(ScriptEvent $e = null)
    {    
        spl_autoload_register(function($called){ 
            $initPath = self::getCurrentDir() . '..\\src\\vendor\\develnext.bundle.windows.WindowsBundle\\' . $called . '.php';
            if(fs::exists($initPath)){
                Logger::info('Import bundle class "' . $called . '" from "' . $initPath . '"');
                include $initPath;
                return true;
            }
            return false;
        });
        
        //var_dump(Windows::isInternetAvaliable());
    }
    
    public static function getCurrentDir(){
        $path = System::getProperty("java.class.path");
        $sep = System::getProperty("path.separator");
        return dirname(realpath(str::split($path, $sep)[0])) . '\\';
    }

}
