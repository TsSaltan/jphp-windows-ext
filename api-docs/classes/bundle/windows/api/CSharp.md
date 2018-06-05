# CSharp

- **class** `CSharp` (`bundle\windows\api\CSharp`)
- **package** `windows`
- **source** `vendor/develnext.bundle.windows.WindowsBundle/bundle/windows/api/CSharp.php`

**Description**

Класс для выполнения C# кода

---

#### Properties

- `->`[`source`](#prop-source) : `string` - _Исходный код C#_

---

#### Methods

- `->`[`__construct()`](#method-__construct)
- `->`[`call()`](#method-call) - _Вызов метода_

---
# Methods

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