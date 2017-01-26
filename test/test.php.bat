<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;
use bundle\windows\Registry;
use bundle\windows\Task;

/*
var_dump(['is_admin' => Windows::isAdmin()]);	
var_dump(['temp' => Windows::expandEnv('%TEMP%')]);
var_dump(['arch' => Windows::getArch()]);
var_dump(['uuid' => Windows::getUUID()]);

$drives = Windows::getDrives();	
foreach($drives as $drive){
	var_dump([$drive['Name'] => [
		'title' => $drive['VolumeName'],
		'description' => $drive['Description'],
		'serial' => Windows::getDriveSerial($drive['Name'])
	]]);
}
//*/
/*
$reg = Registry::of('HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Internet Explorer')->readFully();
foreach($reg as $r){
	$r->path = 'хуй';
	echo "\n\n[path] " . $r->path . " ################################\n";
	foreach($r as $v){
		$k = $v->value;
		$v->value = $v->key;
		$v->key = $k;
		var_dump([$v->key => $v->value]);
	}
}//*/


$tasks = Task::exists('opera.exe');
var_dump($tasks);
//$tasks->kill();
/*
foreach($tasks as $task){
	var_dump($task->toArray());
}//*/