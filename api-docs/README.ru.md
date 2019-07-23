#### [English](README.md) / **Русский**

---

## windows
> версия 2.1.1, создано с помощью JPPM.

Пакет для взаимодействия с API Windows

### Установка
```
jppm add windows@https://github.com/TsSaltan/jphp-windows-ext
```

### АПИ
**Классы**

#### `bundle\windows`

- [`COM`](classes/bundle/windows/COM.ru.md)- _Класс для работы с COM-портами_
- [`Lan`](classes/bundle/windows/Lan.ru.md)- _Local Area Network_
- [`Metadata`](classes/bundle/windows/Metadata.ru.md)
- [`Prepare`](classes/bundle/windows/Prepare.ru.md)- _Класс позволяет создавать подготовленные запросы (как в PDO)._
- [`Registry`](classes/bundle/windows/Registry.ru.md)- _Класс для работы с реестром Windows_
- [`Startup`](classes/bundle/windows/Startup.ru.md)- _Класс содержит функции для работы с автозапуском_
- [`Task`](classes/bundle/windows/Task.ru.md)
- [`Windows`](classes/bundle/windows/Windows.ru.md)
- [`WindowsException`](classes/bundle/windows/WindowsException.ru.md)- _Класс исключения, выбрасываемого функциями пакета Windows_
- [`WindowsScriptHost`](classes/bundle/windows/WindowsScriptHost.ru.md)- _Методы класса позволяют вызывать функции API Windows, выполнять системные скрипты_
- [`Wlan`](classes/bundle/windows/Wlan.ru.md)- _Wireless lan_

#### `bundle\windows\result`

- [`abstractItem`](classes/bundle/windows/result/abstractItem.ru.md)
- [`abstractResult`](classes/bundle/windows/result/abstractResult.ru.md)
- [`comItem`](classes/bundle/windows/result/comItem.ru.md)
- [`lanAdapter`](classes/bundle/windows/result/lanAdapter.ru.md)
- [`registryItem`](classes/bundle/windows/result/registryItem.ru.md)
- [`registryResult`](classes/bundle/windows/result/registryResult.ru.md)
- [`startupItem`](classes/bundle/windows/result/startupItem.ru.md)
- [`taskItem`](classes/bundle/windows/result/taskItem.ru.md)- _Экземпляр данного класса содержит информацию об одном процессе_
- [`taskResult`](classes/bundle/windows/result/taskResult.ru.md)- _Экземпляр класса содержит список процессов, который был сформирован в одном из методов класса Task_
- [`wlanInterface`](classes/bundle/windows/result/wlanInterface.ru.md)
- [`wshResult`](classes/bundle/windows/result/wshResult.ru.md)