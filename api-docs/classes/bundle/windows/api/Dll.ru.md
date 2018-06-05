# Dll

- **класс** `Dll` (`bundle\windows\api\Dll`)
- **пакет** `windows`
- **исходники** `vendor/develnext.bundle.windows.WindowsBundle/bundle/windows/api/Dll.php`

---

#### Свойства

- `->`[`libName`](#prop-libname) : `mixed`

---

#### Методы

- `->`[`__construct()`](#method-__construct)
- `->`[`createMethod()`](#method-createmethod)
- `->`[`__call()`](#method-__call)
- `->`[`genClassCode()`](#method-genclasscode)

---
# Методы

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