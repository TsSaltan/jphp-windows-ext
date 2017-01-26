<?

define('AUTOLOADER_PATH',  DIR . '..\src\vendor\develnext.bundle.windows.WindowsBundle\\');

spl_autoload_register(function($class) {
    include AUTOLOADER_PATH.$class.'.php';
});