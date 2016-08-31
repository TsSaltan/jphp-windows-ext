<?php
namespace bundle\windows\util;

use bundle\windows\Windows;
use bundle\windows\WindowsException;
use bundle\windows\WindowsScriptHost as WSH;
use php\io\FileStream;
use php\io\File;
use php\lib\fs;

class AbstractUtil
{
	protected static $resoursePath = '.data/windows/utils/',
			  		 $installPath = '%TEMP%\\';

    protected static function install($binName, $binExt){
    	Windows::log('AbstractUtil::install', [$binName, $binExt]);
    	$filenames = [
    		$binName . '-' . Windows::getArch() . '.' . $binExt,
    		$binName . '.' . $binExt
    	];

    	foreach($filenames as $filename){
        	$resoursePath = self::$resoursePath . $filename;
        	$installPath = Windows::expandEnv(self::$installPath . $filename);


        	if(fs::exists($installPath)){
        		Windows::log('AbstractUtil::install', 'already installed to', $installPath);
        		return $installPath;
        	}
        	elseif(WSH::resExists($resoursePath)){
       			$res = WSH::getResContent($resoursePath);
       			if(File::of($installPath)->createNewFile(true)){
       				FileStream::putContents($installPath, $res);
        			Windows::log('AbstractUtil::install', 'successfullt installed to', $installPath);
       				return $installPath;
       			}
       			else throw new WindowsException('Can not install '.$binName. '.' . $binExt . ' utility');
       		}else{
       			Windows::log('AbstractUtil::install', 'res not exists', $resoursePath);
       		}
    	}

    	throw new WindowsException('Utility '.$binName. '.' . $binExt . ' does not exist');
    }
}
