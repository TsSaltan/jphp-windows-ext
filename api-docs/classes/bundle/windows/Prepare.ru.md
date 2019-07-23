# Prepare

- **класс** `Prepare` (`bundle\windows\Prepare`)
- **исходники** `bundle/windows/Prepare.php`

**Описание**

Класс позволяет создавать подготовленные запросы (как в PDO).
Далее подготовленные запросы будут использоваться в запросах к API Windows

---

#### Свойства

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

#### Статичные Методы

- `Prepare ::`[`Query()`](#method-query)

---

#### Методы

- `->`[`__construct()`](#method-__construct)
- `->`[`bindAll()`](#method-bindall)
- `->`[`bind()`](#method-bind)
- `->`[`getQuery()`](#method-getquery)

---
# Статичные Методы

<a name="method-query"></a>

### Query()
```php
Prepare::Query(mixed $query, mixed $params): void
```

---
# Методы

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