<?php
namespace app\modules;

use php\lang\Process;
use behaviour\custom\DropShadowEffectBehaviour;
use php\util\Regex;
use php\util\Scanner;
use php\io\MemoryStream;
use php\lib\str;
use php\lang\System;
use php\framework\Logger;
use php\lib\fs;
use php\gui\framework\AbstractModule;
use php\gui\framework\ScriptEvent; 

use bundle\windows\Windows;
use bundle\windows\Registry;
use bundle\windows\WindowsScriptHost as WSH;


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
//        var_dump(WSH::PowerShell('write-host "asd"'));
        //var_dump(Windows::extractIcon('F:\DevelNextBundles\DevelNext-Windows\gradlew.bat', 'D:/index.png'));
        //die(123);
        //var_dump(Windows::isInternetAvaliable());
        $this->getProductKey();
    }
    
    public static function getCurrentDir(){
        $path = System::getProperty("java.class.path");
        $sep = System::getProperty("path.separator");
        return dirname(realpath(str::split($path, $sep)[0])) . '\\';
    }
    
    
    function getProductKey(){
        var_dump(Windows::getProductKey());
    }
}
