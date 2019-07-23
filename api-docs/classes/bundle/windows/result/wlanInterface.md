# wlanInterface

- **class** `wlanInterface` (`bundle\windows\result\wlanInterface`)
- **source** `bundle/windows/result/wlanInterface.php`

---

#### Properties

- `->`[`name`](#prop-name) : `mixed`
- `->`[`description`](#prop-description) : `mixed`
- `->`[`mac`](#prop-mac) : `mixed`

---

#### Methods

- `->`[`__construct()`](#method-__construct)
- `->`[`getName()`](#method-getname) - _Получить имя интерфейса_
- `->`[`getDescription()`](#method-getdescription) - _Получить описание интерфейса_
- `->`[`getMac()`](#method-getmac) - _Получить mac-адрес_
- `->`[`getProfile()`](#method-getprofile) - _Получить текущий профиль (обычно совпадает с именем подключённой сети)_
- `->`[`getPassword()`](#method-getpassword) - _Получить пароль текущего профиля_
- `->`[`reload()`](#method-reload) - _Перезагрузить интерфейс (нужны права администратора)_
- `->`[`disable()`](#method-disable) - _Отключить интерфейс (нужны права администратора)_
- `->`[`enable()`](#method-enable) - _Включить интерфейс (нужны права администратора)_
- `->`[`disconnect()`](#method-disconnect) - _Отключиться от сети_
- `->`[`reconnect()`](#method-reconnect) - _Переподключиться к текущей сети_
- `->`[`connect()`](#method-connect) - _Подключиться к сети_
- `->`[`getState()`](#method-getstate) - _Получить состояние подключения сети_
- `->`[`getParams()`](#method-getparams) - _Получить список параметров текущего интерфейса_
- `->`[`getNetworks()`](#method-getnetworks) - _Получить список обнаруженных Wi-Fi сетей_
- `->`[`createConfig()`](#method-createconfig) - _Генерация файла профиля (для авторизации в сети WiFi)_

---
# Methods

<a name="method-__construct"></a>

### __construct()
```php
__construct(array $params): void
```

---

<a name="method-getname"></a>

### getName()
```php
getName(): string
```
Получить имя интерфейса

---

<a name="method-getdescription"></a>

### getDescription()
```php
getDescription(): string
```
Получить описание интерфейса

---

<a name="method-getmac"></a>

### getMac()
```php
getMac(): string
```
Получить mac-адрес

---

<a name="method-getprofile"></a>

### getProfile()
```php
getProfile(): string
```
Получить текущий профиль (обычно совпадает с именем подключённой сети)

---

<a name="method-getpassword"></a>

### getPassword()
```php
getPassword(): string
```
Получить пароль текущего профиля

---

<a name="method-reload"></a>

### reload()
```php
reload(): void
```
Перезагрузить интерфейс (нужны права администратора)

---

<a name="method-disable"></a>

### disable()
```php
disable(): void
```
Отключить интерфейс (нужны права администратора)

---

<a name="method-enable"></a>

### enable()
```php
enable(): void
```
Включить интерфейс (нужны права администратора)

---

<a name="method-disconnect"></a>

### disconnect()
```php
disconnect(): void
```
Отключиться от сети

---

<a name="method-reconnect"></a>

### reconnect()
```php
reconnect(): void
```
Переподключиться к текущей сети

---

<a name="method-connect"></a>

### connect()
```php
connect(mixed $ssid, mixed $password): boolean
```
Подключиться к сети

---

<a name="method-getstate"></a>

### getState()
```php
getState(): string
```
Получить состояние подключения сети

---

<a name="method-getparams"></a>

### getParams()
```php
getParams(): array
```
Получить список параметров текущего интерфейса

---

<a name="method-getnetworks"></a>

### getNetworks()
```php
getNetworks(): array
```
Получить список обнаруженных Wi-Fi сетей

---

<a name="method-createconfig"></a>

### createConfig()
```php
createConfig(string $ssid, string $password): string
```
Генерация файла профиля (для авторизации в сети WiFi)