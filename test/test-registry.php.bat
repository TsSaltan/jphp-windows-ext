<?// :2>nul&chcp 65001&cls&java -jar "%~dp0jphp-exec.jar" "%~0"&pause&exit /b
define('DS', '\\');
define('DIR', __DIR__ . DS);
include DIR . "autoloader.inc.php";

###

use bundle\windows\Windows;
use bundle\windows\Registry;
use bundle\windows\Task;

echo "\n### test 1 ###\n";
foreach(Registry::of('HKEY_USERS')->search('S-1-5-21-*') as $item){ 
    var_dump($item->path); 
}

echo "\n### test 2 ###\n";
$reg = Registry::of('HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Internet Explorer')->readFully();
foreach($reg as $r){
	echo "[" . $r->path . "]\n";
	foreach($r as $v){
		echo $v->key .' = '. $v->value . "\n";
	}
}

echo "\n### test 3 ###\n";

$reg = new Registry('HKEY_CURRENT_USER\SOFTWARE\test_from_dn');
$reg->create(); // создание ветви
$reg->add('my_key', 'my_value'); // добавление записей
$reg->add('my_key_2', 'my_value'); 
$reg->add('my_new_key', 'my_new_value'); 
 
// Поиск по значениям
$search = $reg->searchValue('my_val*');
foreach($search as $items){
	echo '[' . $items->path . "]\n";
	foreach ($items as $item){
		echo $item->key . ' = ' . $item->value . "\n";
	}
}

$version = Registry::of('HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Internet Explorer')->read('Version')->value;
var_dump('IE Version: ' . $version);