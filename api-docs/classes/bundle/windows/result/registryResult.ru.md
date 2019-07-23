# registryResult

- **класс** `registryResult` (`bundle\windows\result\registryResult`) **унаследован от** [`abstractResult`](classes/bundle/windows/result/abstractResult.ru.md)
- **исходники** `bundle/windows/result/registryResult.php`

---

#### Свойства

- `->`[`path`](#prop-path) : `string`
- *См. также в родительском классе* [abstractResult](classes/bundle/windows/result/abstractResult.ru.md).

---

#### Методы

- `->`[`__construct()`](#method-__construct)
- `->`[`addData()`](#method-adddata)
- `->`[`toArray()`](#method-toarray)
- `->`[`getPath()`](#method-getpath) - _Получить путь_
- `->`[`registry()`](#method-registry) - _Вернуть класс Registry для текущего пути_
- См. также в родительском классе [abstractResult](classes/bundle/windows/result/abstractResult.ru.md)

---
# Методы

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
Получить путь

---

<a name="method-registry"></a>

### registry()
```php
registry(): Registry
```
Вернуть класс Registry для текущего пути