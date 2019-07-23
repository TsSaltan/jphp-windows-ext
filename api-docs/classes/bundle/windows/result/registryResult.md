# registryResult

- **class** `registryResult` (`bundle\windows\result\registryResult`) **extends** [`abstractResult`](classes/bundle/windows/result/abstractResult.md)
- **source** `bundle/windows/result/registryResult.php`

---

#### Properties

- `->`[`path`](#prop-path) : `string`
- *See also in the parent class* [abstractResult](classes/bundle/windows/result/abstractResult.md).

---

#### Methods

- `->`[`__construct()`](#method-__construct)
- `->`[`addData()`](#method-adddata)
- `->`[`toArray()`](#method-toarray)
- `->`[`getPath()`](#method-getpath) - _Get path_
- `->`[`registry()`](#method-registry) - _Вернуть класс Registry для текущего пути_
- See also in the parent class [abstractResult](classes/bundle/windows/result/abstractResult.md)

---
# Methods

<a name="method-__construct"></a>

### __construct()
```php
__construct(mixed $path): void
```

---

<a name="method-adddata"></a>

### addData()
```php
addData(mixed $key, mixed $type, mixed $value): void
```

---

<a name="method-toarray"></a>

### toArray()
```php
toArray(): void
```

---

<a name="method-getpath"></a>

### getPath()
```php
getPath(): string
```
Get path

---

<a name="method-registry"></a>

### registry()
```php
registry(): Registry
```
Вернуть класс Registry для текущего пути