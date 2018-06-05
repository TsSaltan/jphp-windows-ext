# CSharp

- **класс** `CSharp` (`bundle\windows\api\CSharp`)
- **пакет** `windows`
- **исходники** `vendor/develnext.bundle.windows.WindowsBundle/bundle/windows/api/CSharp.php`

**Описание**

Класс для выполнения C# кода

---

#### Свойства

- `->`[`source`](#prop-source) : `string` - _Исходный код C#_

---

#### Методы

- `->`[`__construct()`](#method-__construct)
- `->`[`call()`](#method-call) - _Вызов метода_

---
# Методы

<a name="method-__construct"></a>

### __construct()
```php
__construct(mixed $source): void
```

---

<a name="method-call"></a>

### call()
```php
call(string $class, string $method, array $args): string
```
Вызов метода