<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;
use bundle\windows\Registry;
use bundle\windows\COM;


$a = COM::searchDevice('CH340');
var_dump($a);
var_dump($a['COM4']->connect()->read(100));
die;

use php\io\MiscStream;

$port = 'COM4';
$stream = MiscStream::of($port, 'a');
var_dump($stream);
$stream->write('+');
var_dump('aaa');
///$stream->seek(0);
var_dump('bbb');

while($stream->eof()){
	$item = $stream->read(1);
	if($item == '{'){
		$json = $item;
	} elseif($item == '}') {
		onJson($json . '}');
	} else {
		$json.=$item;
	}

	var_dump(['n' => $json]);
}

function onJson($json){
	$data = json_decode($json);
	if(!$data || $data === null) return;

	var_dump(['onJson' => $data]);
}

// var_dump(Windows::getCOM());
           
die;
var_dump(Windows::getTotalRAM());
var_dump(['is_admin' => Windows::isAdmin()]);	
var_dump(['temp' => Windows::expandEnv('%programdata%\\Windows\\')]);
var_dump(['appData' => Windows::expandEnv('%appdata%')]);
var_dump(['arch' => Windows::getArch()]);
var_dump(['uuid' => Windows::getUUID()]);