<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Startup;
use bundle\windows\Registry;
use bundle\windows\WindowsException;


$startup = Startup::loadDisabled();
return var_dump($startup);