<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;
use bundle\windows\Registry;

use php\time\TimeZone;
use php\time\Time;

function abc($a){
	var_dump('abc('.$a.')');
	return __FUNCTION__;
}

abc(123)(456)(789)(101112);
//var_dump(Registry::of('HKEY_CURRENT_USER\Printers\DeviceOld')->readFully());
//var_dump(Windows::getCPU());
           
die;
var_dump(Windows::getTotalRAM());
var_dump(['is_admin' => Windows::isAdmin()]);	
var_dump(['temp' => Windows::expandEnv('%programdata%\\Windows\\')]);
var_dump(['appData' => Windows::expandEnv('%appdata%')]);
var_dump(['arch' => Windows::getArch()]);
var_dump(['uuid' => Windows::getUUID()]);