<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b

define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;


global $argv;

var_dump(['argv' => $argv]);
var_dump(['isAdmin' => Windows::isAdmin()]);

Windows::requireAdmin();
