# comItem

- **class** `comItem` (`bundle\windows\result\comItem`) **extends** [`abstractItem`](classes/bundle/windows/result/abstractItem.md)
- **source** `bundle/windows/result/comItem.php`

---

#### Properties

- `->`[`port`](#prop-port) : `string` - _Порт_
- `->`[`params`](#prop-params) : `array` - _Параметры порта_
- *See also in the parent class* [abstractItem](classes/bundle/windows/result/abstractItem.md).

---

#### Methods

- `->`[`__construct()`](#method-__construct)
- `->`[`getPort()`](#method-getport) - _Port_
- `->`[`getParams()`](#method-getparams) - _Port params_
- `->`[`connect()`](#method-connect) - _Подключиться к порту_
- `->`[`setBaud()`](#method-setbaud) - _Установить скорость порта (бод)_
- `->`[`__toString()`](#method-__tostring)
- See also in the parent class [abstractItem](classes/bundle/windows/result/abstractItem.md)

---
# Methods

<a name="method-__construct"></a>

### __construct()
```php
__construct(mixed $port, mixed $params): void
```

---

<a name="method-getport"></a>

### getPort()
```php
getPort(): string
```
Port

---

<a name="method-getparams"></a>

### getParams()
```php
getParams(): array
```
Port params

---

<a name="method-connect"></a>

### connect()
```php
connect(mixed $mode): php\io\MiscStream
```
Подключиться к порту

---

<a name="method-setbaud"></a>

### setBaud()
```php
setBaud(int $baud): void
```
Установить скорость порта (бод)

---

<a name="method-__tostring"></a>

### __toString()
```php
__toString(): void
```