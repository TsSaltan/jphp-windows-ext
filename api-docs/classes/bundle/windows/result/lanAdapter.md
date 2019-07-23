# lanAdapter

- **class** `lanAdapter` (`bundle\windows\result\lanAdapter`)
- **source** `bundle/windows/result/lanAdapter.php`

---

#### Properties

- `->`[`name`](#prop-name) : `mixed`
- `->`[`device`](#prop-device) : `mixed`
- `->`[`params`](#prop-params) : `mixed`
- `->`[`ipv4`](#prop-ipv4) : `mixed`
- `->`[`ipv6`](#prop-ipv6) : `mixed`
- `->`[`mac`](#prop-mac) : `mixed`

---

#### Methods

- `->`[`__construct()`](#method-__construct)
- `->`[`getName()`](#method-getname) - _Получить имя адаптера_
- `->`[`getParams()`](#method-getparams) - _Получить параметры адаптера_
- `->`[`getDevice()`](#method-getdevice) - _Получить описание устройства_
- `->`[`getMac()`](#method-getmac) - _Получить mac адрес_
- `->`[`getIPv4()`](#method-getipv4) - _Получить IPv4 адрес_
- `->`[`getIPv6()`](#method-getipv6) - _Получить IPv6 адрес_
- `->`[`isNetworkEnabled()`](#method-isnetworkenabled) - _Доступна ли сеть на данном адаптере_
- `->`[`isConnected()`](#method-isconnected) - _Подключен ли сетевой кабель_
- `->`[`isEnabled()`](#method-isenabled) - _Включен ли адаптер_
- `->`[`disable()`](#method-disable) - _Отключить адаптер (нужны права администратора)_
- `->`[`enable()`](#method-enable) - _Включить интерфейс (нужны права администратора)_

---
# Methods

<a name="method-__construct"></a>

### __construct()
```php
__construct(string $name, array $params): void
```

---

<a name="method-getname"></a>

### getName()
```php
getName(): string
```
Получить имя адаптера

---

<a name="method-getparams"></a>

### getParams()
```php
getParams(): array
```
Получить параметры адаптера

---

<a name="method-getdevice"></a>

### getDevice()
```php
getDevice(): string
```
Получить описание устройства

---

<a name="method-getmac"></a>

### getMac()
```php
getMac(): string
```
Получить mac адрес

---

<a name="method-getipv4"></a>

### getIPv4()
```php
getIPv4(): string
```
Получить IPv4 адрес

---

<a name="method-getipv6"></a>

### getIPv6()
```php
getIPv6(): string
```
Получить IPv6 адрес

---

<a name="method-isnetworkenabled"></a>

### isNetworkEnabled()
```php
isNetworkEnabled(): boolean
```
Доступна ли сеть на данном адаптере

---

<a name="method-isconnected"></a>

### isConnected()
```php
isConnected(): boolean
```
Подключен ли сетевой кабель

---

<a name="method-isenabled"></a>

### isEnabled()
```php
isEnabled(): boolean
```
Включен ли адаптер

---

<a name="method-disable"></a>

### disable()
```php
disable(): boolean
```
Отключить адаптер (нужны права администратора)

---

<a name="method-enable"></a>

### enable()
```php
enable(): boolean
```
Включить интерфейс (нужны права администратора)