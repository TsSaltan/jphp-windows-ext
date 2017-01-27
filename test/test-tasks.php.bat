<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Task;


$tasks = Task::find('opera.exe');

$tab = null;
$memory = 0;

foreach($tasks as $task){
	if(!is_null($task->title))$tab = $task->title;
	$memory += $task->memory;
}

echo "Task opera.exe used " . $tasks->length() . " processes \n";
echo "Memory used " . round($memory / 1024 / 1024, 3) . " MiB \n";
echo "Opened tab: " . $tab;
//$tasks->kill();