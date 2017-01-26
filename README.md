**[Wiki](https://tssaltan.ru/1156.develnext-windows/#wiki)**

**[Тема на форуме](http://community.develstudio.org/showthread.php/13689-Модуль-для-работы-с-ОС-Windows)**

## Changelog
```
--- 1.0 ---
... in progress

--- 0.5 ---
[Change] Модуль переделан в пакет расширений
[Add] Встроена утилита nircmd, что позволило расширить функционал
[Add] Windows::getArch()
[Add] Windows::scanNetwork()
[Add] Windows::expandEnv()
[Add] Windows::setVolume()
[Add] Windows::setBrightness()
[Add] Windows::emptyBin()
[Add] Windows::speak()

--- 0.4.0.3 ---
[Fix] Windows::regRead();

--- 0.4.0.2 ---
[Add] Windows::getAdmin();
[Fix] Windows::getMAC();
```


## Build
```
gradlew bundle
```