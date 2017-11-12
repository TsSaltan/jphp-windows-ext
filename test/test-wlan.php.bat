<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Wlan;


if(Wlan::isSupported()){
	var_dump($i = Wlan::getInterfaces());
	var_dump($i[0]->getState());
	var_dump($i[0]->getNetworks());
}