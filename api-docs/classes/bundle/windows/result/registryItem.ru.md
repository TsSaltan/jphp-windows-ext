# registryItem

- **класс** `registryItem` (`bundle\windows\result\registryItem`) **унаследован от** [`abstractItem`](classes/bundle/windows/result/abstractItem.ru.md)
- **исходники** `bundle/windows/result/registryItem.php`

---

#### Свойства

- `->`[`key`](#prop-key) : `mixed` - _Ключ_
- `->`[`value`](#prop-value) : `mixed` - _Значение_
- `->`[`type`](#prop-type) : `string` - _Тип значения_
- *См. также в родительском классе* [abstractItem](classes/bundle/windows/result/abstractItem.ru.md).

---

#### Методы

- `->`[`__construct()`](#method-__construct)
- `->`[`getType()`](#method-gettype) - _Тип_
- `->`[`getKey()`](#method-getkey) - _Название ключа._
- `->`[`getValue()`](#method-getvalue) - _Значение._
- `->`[`__toString()`](#method-__tostring)
- См. также в родительском классе [abstractItem](classes/bundle/windows/result/abstractItem.ru.md)

---
# Методы

<a name="method-__construct"></a>

### __construct()
```php
__construct(mixed $key, mixed $type, mixed $value): void
```

---

<a name="method-gettype"></a>

### getType()
```php
getType(): string
```
Тип

---

<a name="method-getkey"></a>

### getKey()
```php
getKey(): string
```
Название ключа.

---

<a name="method-getvalue"></a>

### getValue()
```php
getValue(): string
```
Значение.

---

<a name="method-__tostring"></a>

### __toString()
```php
__toString(): void
```