# Registry

- **класс** `Registry` (`bundle\windows\Registry`)
- **пакет** `windows`
- **исходники** `bundle/windows/Registry.php`

**Описание**

Класс для работы с реестром Windows

---

#### Свойства

- `->`[`path`](#prop-path) : `string` - _Путь к разделу реестра_

---

#### Статичные Методы

- `Registry ::`[`of()`](#method-of) - _Alias __construct_
- `Registry ::`[`HKCR()`](#method-hkcr) - _HKEY_CLASSES_ROOT_
- `Registry ::`[`HKCU()`](#method-hkcu) - _HKEY_CURRENT_USER_
- `Registry ::`[`HKLM()`](#method-hklm) - _HKEY_LOCAL_MACHINE_
- `Registry ::`[`HKU()`](#method-hku) - _HKEY_USERS_
- `Registry ::`[`HKCC()`](#method-hkcc) - _HKEY_CURRENT_CONFIG_

---

#### Методы

- `->`[`__construct()`](#method-__construct)
- `->`[`readFully()`](#method-readfully) - _Полное чтение содержимого раздела (ключ, значения, подразделы)_
- `->`[`read()`](#method-read) - _Чтение ключа_
- `->`[`add()`](#method-add) - _Добавить новый параметр в реестр_
- `->`[`create()`](#method-create) - _Создать раздел реестра_
- `->`[`delete()`](#method-delete) - _Удалить раздел реестра_
- `->`[`clear()`](#method-clear) - _Удалить содержимое раздела_
- `->`[`deleteKey()`](#method-deletekey) - _Удалить ключ из реестра_
- `->`[`search()`](#method-search) - _Поиск по ключам и разделам_
- `->`[`searchValue()`](#method-searchvalue) - _Поиск по значениям_
- `->`[`parseAnswer()`](#method-parseanswer)
- `->`[`query()`](#method-query)

---
# Статичные Методы

<a name="method-of"></a>

### of()
```php
Registry::of(mixed $path): Registry
```
Alias __construct

---

<a name="method-hkcr"></a>

### HKCR()
```php
Registry::HKCR(): Registry
```
HKEY_CLASSES_ROOT

---

<a name="method-hkcu"></a>

### HKCU()
```php
Registry::HKCU(): Registry
```
HKEY_CURRENT_USER

---

<a name="method-hklm"></a>

### HKLM()
```php
Registry::HKLM(): Registry
```
HKEY_LOCAL_MACHINE

---

<a name="method-hku"></a>

### HKU()
```php
Registry::HKU(): Registry
```
HKEY_USERS

---

<a name="method-hkcc"></a>

### HKCC()
```php
Registry::HKCC(): Registry
```
HKEY_CURRENT_CONFIG

---
# Методы

<a name="method-__construct"></a>

### __construct()
```php
__construct(string $path): void
```

---

<a name="method-readfully"></a>

### readFully()
```php
readFully(mixed $recursive): registryResult[]
```
Полное чтение содержимого раздела (ключ, значения, подразделы)

---

<a name="method-read"></a>

### read()
```php
read(string $key): registryItem
```
Чтение ключа

---

<a name="method-add"></a>

### add()
```php
add(string $key, string $value, string $type): void
```
Добавить новый параметр в реестр

---

<a name="method-create"></a>

### create()
```php
create(): void
```
Создать раздел реестра

---

<a name="method-delete"></a>

### delete()
```php
delete(): void
```
Удалить раздел реестра

---

<a name="method-clear"></a>

### clear()
```php
clear(): void
```
Удалить содержимое раздела

---

<a name="method-deletekey"></a>

### deleteKey()
```php
deleteKey(string $key): void
```
Удалить ключ из реестра

---

<a name="method-search"></a>

### search()
```php
search(string $search, mixed $recursive, mixed $fullEqual): registryResult[]
```
Поиск по ключам и разделам

---

<a name="method-searchvalue"></a>

### searchValue()
```php
searchValue(string $search, mixed $recursive, mixed $fullEqual): registryResult[]
```
Поиск по значениям

---

<a name="method-parseanswer"></a>

### parseAnswer()
```php
parseAnswer(mixed $answer): void
```

---

<a name="method-query"></a>

### query()
```php
query(string $command, array $vars): void
```