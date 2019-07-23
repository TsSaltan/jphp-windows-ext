# Prepare

- **class** `Prepare` (`bundle\windows\Prepare`)
- **source** `bundle/windows/Prepare.php`

**Description**

Класс позволяет создавать подготовленные запросы (как в PDO).
Далее подготовленные запросы будут использоваться в запросах к API Windows

---

#### Properties

- `->`[`source`](#prop-source) : `mixed`
- `->`[`vars`](#prop-vars) : `mixed`
- `->`[`safeQuery`](#prop-safequery) : `mixed`
- `->`[`addStringQuotes`](#prop-addstringquotes) : `boolean` - _Обрамлять переменную кавычками_
- `->`[`quotesPolicy`](#prop-quotespolicy) : `int` - _Режим управления кавычками
0 - ничего не делаем
1 - кавычки экранируются \"
2 - кавычки экранируются ""_
- `->`[`replaceEmpty`](#prop-replaceempty) : `boolean` - _Заменить отсутствующие переменные на NULL_

---

#### Static Methods

- `Prepare ::`[`Query()`](#method-query)

---

#### Methods

- `->`[`__construct()`](#method-__construct)
- `->`[`bindAll()`](#method-bindall)
- `->`[`bind()`](#method-bind)
- `->`[`getQuery()`](#method-getquery)

---
# Static Methods

<a name="method-query"></a>

### Query()
```php
Prepare::Query(mixed $query, mixed $params): void
```

---
# Methods

<a name="method-__construct"></a>

### __construct()
```php
__construct(mixed $query): void
```

---

<a name="method-bindall"></a>

### bindAll()
```php
bindAll(array $bindParams): void
```

---

<a name="method-bind"></a>

### bind()
```php
bind(mixed $key, mixed $value, mixed $type): void
```

---

<a name="method-getquery"></a>

### getQuery()
```php
getQuery(mixed $bindParams): void
```