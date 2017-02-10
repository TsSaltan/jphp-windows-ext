<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;
/*
Windows::setMute(true);
var_dump(Windows::getMute());
sleep(3);

Windows::setMute(false);
var_dump(Windows::getMute());
sleep(3);

$level = rand(1,10);
var_dump([
	'setVolumeLevel('.$level.')' => Windows::setVolumeLevel($level),
	'getVolumeLevel' => Windows::getVolumeLevel(),
]);

sleep(10);*/

$level = rand(50,100);
var_dump(['setBrightnessLevel('.$level.')' => Windows::setBrightnessLevel($level)]);

//var_dump(Windows::getBrightnessLevel());

var_dump([
	'getBatteryTimeRemaining' => Windows::getBatteryTimeRemaining(),
	'getBatteryPercent' => Windows::getBatteryPercent(),
	'getBatteryVoltage' => Windows::getBatteryVoltage(),
	'isBatteryCharging' => Windows::isBatteryCharging(),
]);

var_dump(Windows::getBatteryInfo());

// Get-Ciminstance -Namespace root/WMI -ClassName WmiMonitorBrightness