# Dll

- **class** `Dll` (`bundle\windows\api\Dll`)
- **package** `windows`
- **source** `vendor/develnext.bundle.windows.WindowsBundle/bundle/windows/api/Dll.php`

---

#### Properties

- `->`[`libName`](#prop-libname) : `mixed`

---

#### Methods

- `->`[`__construct()`](#method-__construct)
- `->`[`createMethod()`](#method-createmethod)
- `->`[`__call()`](#method-__call)
- `->`[`genClassCode()`](#method-genclasscode)

---
# Methods

<a name="method-__construct"></a>

### __construct()
```php
__construct(mixed $libName): void
```

---

<a name="method-createmethod"></a>

### createMethod()
```php
createMethod(mixed $methodName, mixed $argsString, mixed $source): void
```

---

<a name="method-__call"></a>

### __call()
```php
__call(string $method, array $args): void
```

---

<a name="method-genclasscode"></a>

### genClassCode()
```php
genClassCode(mixed $method, mixed $argString, mixed $returnType): void
```