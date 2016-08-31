<?php
namespace bundle\windows\util;

use bundle\windows\util\AbstractUtil;
use bundle\windows\WindowsScriptHost as WSH;


class LibUtil extends AbstractUtil
{
    public static function register($libName){
        self::$resoursePath = '.data/windows/utils/lib/';
        self::$installPath = '%TEMP%\\dnLibs\\';

        $libName = explode('.', $libName);
        $path = self::install($libName[0], $libName[1]);
        return WSH::execResScript('regSrv', 'bat', ['libPath' => $path]);
    }

    public static function runScript($libName, $script, $type, $params = []){
        self::register($libName);
        return WSH::execResScript($script, $type, $params);
    }
}