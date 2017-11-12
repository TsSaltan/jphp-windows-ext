<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b

define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;
use bundle\windows\WindowsScriptHost as WSH;
use bundle\windows\Registry;
use bundle\windows\COM;
use bundle\windows\WindowsException;


foreach(COM::searchDevice('CH340') as $arduino){
	var_dump('Connected to ' . $arduino->getPort());
	//var_dump($arduino->getParams());

	$arduino->setBaud(1000000);
	
	$stream = $arduino->connect('w+');
	$stream->seek(0);
	var_dump('Open stream');
	//var_dump($stream->read(1));

	$arduino->inputReciever(function($item){
		echo $item;
	});
	/*
	var_dump('seek0');*/

	/*var_dump([ 'getPosition' => $stream->getPosition() ]);
	var_dump([ 'length' => $stream->length() ]);
	var_dump([ 'eof' => $stream->eof() ]);
	//var_dump(get_class_vars($stream));
*/
	$stream->write(123);

	break;
}
//*/