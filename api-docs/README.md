#### **English** / [Русский](README.ru.md)

---

## windows
> version 2.1.1, created by JPPM.

Пакет для взаимодействия с API Windows

### Install
```
jppm add windows@git+https://github.com/TsSaltan/jphp-windows-ext
```

### API
**Classes**

#### `bundle\windows`

- [`COM`](classes/bundle/windows/COM.md)- _Класс для работы с COM-портами_
- [`Lan`](classes/bundle/windows/Lan.md)- _Local Area Network_
- [`Metadata`](classes/bundle/windows/Metadata.md)
- [`Prepare`](classes/bundle/windows/Prepare.md)- _Класс позволяет создавать подготовленные запросы (как в PDO)._
- [`Registry`](classes/bundle/windows/Registry.md)- _Класс для работы с реестром Windows_
- [`Startup`](classes/bundle/windows/Startup.md)- _Класс содержит функции для работы с автозапуском_
- [`Task`](classes/bundle/windows/Task.md)
- [`Windows`](classes/bundle/windows/Windows.md)
- [`WindowsException`](classes/bundle/windows/WindowsException.md)- _Класс исключения, выбрасываемого функциями пакета Windows_
- [`WindowsScriptHost`](classes/bundle/windows/WindowsScriptHost.md)- _Методы класса позволяют вызывать функции API Windows, выполнять системные скрипты_
- [`Wlan`](classes/bundle/windows/Wlan.md)- _Wireless lan_

#### `bundle\windows\result`

- [`abstractItem`](classes/bundle/windows/result/abstractItem.md)
- [`abstractResult`](classes/bundle/windows/result/abstractResult.md)
- [`comItem`](classes/bundle/windows/result/comItem.md)
- [`lanAdapter`](classes/bundle/windows/result/lanAdapter.md)
- [`registryItem`](classes/bundle/windows/result/registryItem.md)
- [`registryResult`](classes/bundle/windows/result/registryResult.md)
- [`startupItem`](classes/bundle/windows/result/startupItem.md)
- [`taskItem`](classes/bundle/windows/result/taskItem.md)- _Экземпляр данного класса содержит информацию об одном процессе_
- [`taskResult`](classes/bundle/windows/result/taskResult.md)- _Экземпляр класса содержит список процессов, который был сформирован в одном из методов класса Task_
- [`wlanInterface`](classes/bundle/windows/result/wlanInterface.md)
- [`wshResult`](classes/bundle/windows/result/wshResult.md)