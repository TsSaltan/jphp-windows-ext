<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;
use bundle\windows\Registry;
use bundle\windows\COM;


        
use php\io\MiscStream;
use php\io\FileStream;

$port = 'COM4';
$stream = FileStream::of($port, 'w');
$stream->write("+\r\n");
$stream->close();
var_dump('aaa');
//$stream->flush();
var_dump('bbb');

$stream = FileStream::of($port, 'r');

var_dump('ccc');
echo $stream->read(2);
var_dump('ddd');
while($stream->eof()){
	echo $stream->read(2);
}
           
die('-end');
var_dump(Windows::getTotalRAM());
var_dump(['is_admin' => Windows::isAdmin()]);	
var_dump(['temp' => Windows::expandEnv('%programdata%\\Windows\\')]);
var_dump(['appData' => Windows::expandEnv('%appdata%')]);
var_dump(['arch' => Windows::getArch()]);
var_dump(['uuid' => Windows::getUUID()]);