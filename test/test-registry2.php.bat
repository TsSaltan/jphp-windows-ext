<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;
use bundle\windows\Registry;
use bundle\windows\Task;


$reg = Registry::of('HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Internet Explorer')->readFully(true);
foreach($reg as $r){
	echo "\n[" . $r->path . "]\n";
	foreach($r as $v){
		echo $v->key .' = '. $v->value . "\n";
	}
}
