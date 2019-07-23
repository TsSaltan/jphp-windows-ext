# Startup

- **class** `Startup` (`bundle\windows\Startup`)
- **package** `windows`
- **source** `bundle/windows/Startup.php`

**Description**

Класс содержит функции для работы с автозапуском

---

#### Static Methods

- `Startup ::`[`getList()`](#method-getlist) - _Получить список программ, находящихся в автозагрузке_
- `Startup ::`[`loadWMIC()`](#method-loadwmic) - _Загрузка элементов из WMI_
- `Startup ::`[`loadRegistry()`](#method-loadregistry) - _Загрузка элементов из реестра_
- `Startup ::`[`loadDisabled()`](#method-loaddisabled)
- `Startup ::`[`expandRegPath()`](#method-expandregpath)
- `Startup ::`[`add()`](#method-add) - _Добавляет программу в автозагрузку_
- `Startup ::`[`find()`](#method-find) - _Найти запись в автозапуске по исполняемому файлу_
- `Startup ::`[`isExists()`](#method-isexists) - _Находится ли данный файл в автозапуске_
- `Startup ::`[`getUserStartupDirectory()`](#method-getuserstartupdirectory) - _Возвращает путь к пользовательской папке автозагрузки_
- `Startup ::`[`getCommonStartupDirectory()`](#method-getcommonstartupdirectory) - _Возвращает путь к папке автозагрузки для программ_

---
# Static Methods

<a name="method-getlist"></a>

### getList()
```php
Startup::getList(): startupItem[]
```
Получить список программ, находящихся в автозагрузке

---

<a name="method-loadwmic"></a>

### loadWMIC()
```php
Startup::loadWMIC(): array
```
Загрузка элементов из WMI

---

<a name="method-loadregistry"></a>

### loadRegistry()
```php
Startup::loadRegistry(): array
```
Загрузка элементов из реестра

---

<a name="method-loaddisabled"></a>

### loadDisabled()
```php
Startup::loadDisabled(): array
```

---

<a name="method-expandregpath"></a>

### expandRegPath()
```php
Startup::expandRegPath(mixed $path): string
```

---

<a name="method-add"></a>

### add()
```php
Startup::add(string $file, mixed $description): bundle\windows\result\startupItem
```
Добавляет программу в автозагрузку

---

<a name="method-find"></a>

### find()
```php
Startup::find(string $file): bundle\windows\result\startupItem
```
Найти запись в автозапуске по исполняемому файлу

---

<a name="method-isexists"></a>

### isExists()
```php
Startup::isExists(string $file): bool
```
Находится ли данный файл в автозапуске

---

<a name="method-getuserstartupdirectory"></a>

### getUserStartupDirectory()
```php
Startup::getUserStartupDirectory(): string
```
Возвращает путь к пользовательской папке автозагрузки

---

<a name="method-getcommonstartupdirectory"></a>

### getCommonStartupDirectory()
```php
Startup::getCommonStartupDirectory(): string
```
Возвращает путь к папке автозагрузки для программ