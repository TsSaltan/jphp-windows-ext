<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Startup;
use bundle\windows\Registry;
use bundle\windows\Windows;
use bundle\windows\WindowsException;

if(!Windows::isAdmin()){
	global $argv;
	Windows::runAsAdmin('cmd.exe', '/c ' . implode(' ', $argv));
	echo "Restarting as admin...";
	die;
}

$startup = Startup::getList();
return var_dump($startup);

