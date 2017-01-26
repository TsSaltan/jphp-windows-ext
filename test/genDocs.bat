<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;
use bundle\windows\Registry;
use bundle\windows\Task;


function genDoc($file){
	$input = file_get_contents($file);

	$regex = '~(\/\*\*.*?\*\/)?[\r\n\t\s]+(\s+[private|public|protected]+)(\s+static)?\s+(\$[^;]+;)~six';
	preg_match_all($regex, $input, $vars);
	return var_dump($vars);
	
	$regex = '~(\/\*\*.*?\*\/)?[\r\n\t\s]+(\s+[private|public|protected]+)(\s+static)?\s+function\s+(.*?)\s*(\(.*?\))\s*\{.*?\}~six';
	preg_match_all($regex, $input, $matches);

	$doc = 'class ' . str_replace('.php', '', basename($file)) . " {\n";
	//return var_dump($matches);

	foreach($matches[2] as $k => $v){
		if(trim($v) == 'public'){
			/*var_dump(['remove' => $matches[2][$k] . $matches[3][$k] . ' function ' . $matches[4][$k] . $matches[5][$k]]);
			$iput = str_replace($matches[2][$k] . $matches[3][$k] . ' function ' . $matches[4][$k] . $matches[5][$k] , null, $input);*/

			$doc .= trim(str_replace(["\t", '  ', '   '], null, $matches[1][$k])) . "\n" . trim($matches[2][$k]) . ' ' .trim($matches[3][$k]) . ' function ' .trim($matches[4][$k]) . trim($matches[5][$k]) . ";\n\n";
		}

		
	}
	$doc .= '}';
	return $doc;

}

$files = [
	'Registry.php',
	'Startup.php',
	'Windows.php',
	'WindowsScriptHost.php',
	'Task.php',
];
$a = genDoc(AUTOLOADER_PATH . DS . 'bundle\windows\result\startupItem.php');
var_dump($a);