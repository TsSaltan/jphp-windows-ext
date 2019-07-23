# comItem

- **класс** `comItem` (`bundle\windows\result\comItem`) **унаследован от** [`abstractItem`](classes/bundle/windows/result/abstractItem.ru.md)
- **исходники** `bundle/windows/result/comItem.php`

---

#### Свойства

- `->`[`port`](#prop-port) : `string` - _Порт_
- `->`[`params`](#prop-params) : `array` - _Параметры порта_
- *См. также в родительском классе* [abstractItem](classes/bundle/windows/result/abstractItem.ru.md).

---

#### Методы

- `->`[`__construct()`](#method-__construct)
- `->`[`getPort()`](#method-getport) - _Порт_
- `->`[`getParams()`](#method-getparams) - _Параметры_
- `->`[`connect()`](#method-connect) - _Подключиться к порту_
- `->`[`setBaud()`](#method-setbaud) - _Установить скорость порта (бод)_
- `->`[`__toString()`](#method-__tostring)
- См. также в родительском классе [abstractItem](classes/bundle/windows/result/abstractItem.ru.md)

---
# Методы

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
Порт

---

<a name="method-getparams"></a>

### getParams()
```php
getParams(): array
```
Параметры

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