<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;

var_dump(['is_admin' => Windows::isAdmin()]);	
var_dump(['temp' => Windows::expandEnv('%TEMP%')]);
var_dump(['appData' => Windows::expandEnv('%appdata%')]);
var_dump(['arch' => Windows::getArch()]);
var_dump(['uuid' => Windows::getUUID()]);