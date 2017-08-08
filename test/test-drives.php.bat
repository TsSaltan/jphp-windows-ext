<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;


var_dump($drives = Windows::getDrives());	die;
foreach($drives as $drive){
	var_dump([$drive['Name'] => [
		'title' => $drive['VolumeName'],
		'description' => $drive['Description'],
		'serial' => Windows::getDriveSerial($drive['Name'])
	]]);
}

/* output:
...
array(1) {
  ["E:"]=>
  array(3) {
    ["title"]=>
    string(9) "HDD/Media"
    ["description"]=>
    string(24) "Локальный несъемный диск"
    ["serial"]=>
    string(8) "3ND1XKS8"
  }
}
array(1) {
  ["F:"]=>
  array(3) {
    ["title"]=>
    string(7) "HDD/Dev"
    ["description"]=>
    string(24) "Локальный несъемный диск"
    ["serial"]=>
    string(8) "3ND1XKS8"
  }
}
array(1) {
  ["G:"]=>
  array(3) {
    ["title"]=>
    string(4) "E200"
    ["description"]=>
    string(12) "Съемный диск"
    ["serial"]=>
    string(4) "UBI0"
  }
}
array(1) {
  ["H:"]=>
  array(3) {
    ["description"]=>
    string(12) "Компакт-диск"
    ["serial"]=>
    NULL
  }
}
...
*/