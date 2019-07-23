# startupItem

- **класс** `startupItem` (`bundle\windows\result\startupItem`) **унаследован от** [`abstractItem`](classes/bundle/windows/result/abstractItem.ru.md)
- **исходники** `bundle/windows/result/startupItem.php`

---

#### Свойства

- `->`[`title`](#prop-title) : `string` - _Заголовок_
- `->`[`command`](#prop-command) : `string` - _Команда для запуска_
- `->`[`file`](#prop-file) : `string` - _Путь к файлу_
- `->`[`shortcut`](#prop-shortcut) : `string` - _Путь к ярлыку_
- `->`[`forAllUsers`](#prop-forallusers) : `bool` - _Для всех пользователей_
- `->`[`location`](#prop-location) : `string` - _Расположение записи (Реестр, папка startup и т.д.)_
- *См. также в родительском классе* [abstractItem](classes/bundle/windows/result/abstractItem.ru.md).

---

#### Методы

- `->`[`__construct()`](#method-__construct)
- `->`[`isForAllUsers()`](#method-isforallusers) - _Автозагрузка для всех пользователей_
- `->`[`getFileFromCommand()`](#method-getfilefromcommand)
- `->`[`delete()`](#method-delete) - _Удалить объект из автозагрузки_
- `->`[`getTitle()`](#method-gettitle) - _Заголовок_
- `->`[`getCommand()`](#method-getcommand) - _Команда для запуска_
- `->`[`getFile()`](#method-getfile) - _Путь к исполняемому файлу_
- `->`[`getShortcut()`](#method-getshortcut) - _Путь к ярлыку для запуска_
- `->`[`getLocation()`](#method-getlocation) - _Расположение записи для запуска_
- См. также в родительском классе [abstractItem](classes/bundle/windows/result/abstractItem.ru.md)

---
# Методы

<a name="method-__construct"></a>

### __construct()
```php
__construct(mixed $title, mixed $command, mixed $location): void
```

---

<a name="method-isforallusers"></a>

### isForAllUsers()
```php
isForAllUsers(): bool
```
Автозагрузка для всех пользователей

---

<a name="method-getfilefromcommand"></a>

### getFileFromCommand()
```php
getFileFromCommand(mixed $command): void
```

---

<a name="method-delete"></a>

### delete()
```php
delete(): bool
```
Удалить объект из автозагрузки

---

<a name="method-gettitle"></a>

### getTitle()
```php
getTitle(): string
```
Заголовок

---

<a name="method-getcommand"></a>

### getCommand()
```php
getCommand(): string
```
Команда для запуска

---

<a name="method-getfile"></a>

### getFile()
```php
getFile(): string
```
Путь к исполняемому файлу

---

<a name="method-getshortcut"></a>

### getShortcut()
```php
getShortcut(): string
```
Путь к ярлыку для запуска

---

<a name="method-getlocation"></a>

### getLocation()
```php
getLocation(): string
```
Расположение записи для запуска