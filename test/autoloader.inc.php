<?
spl_autoload_register(function($class) {
    include DIR . '..\src\vendor\develnext.bundle.windows.WindowsBundle\\'.$class.'.php';
});