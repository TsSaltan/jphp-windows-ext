<?php
namespace bundle\windows\util;

use bundle\windows\util\AbstractUtil;
use bundle\windows\Windows;
use bundle\windows\WindowsScriptHost as WSH;


class ExeUtil extends AbstractUtil
{
    private static function register($binName){
        self::$resoursePath = '.data/windows/utils/exe/';
        self::$installPath = '%TEMP%\\dnBins\\';

        return self::install($binName, 'exe');
    }

    public static function run(){
        $cmd = func_get_args();
        $cmd[0] = self::register($cmd[0]);
        Windows::log('Exe::run', ['path' => $path, 'cmd' => func_get_args()]);
        return WSH::cmd(implode(' ', $cmd), false);
    }
}