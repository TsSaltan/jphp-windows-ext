# WindowsScriptHost

- **class** `WindowsScriptHost` (`bundle\windows\WindowsScriptHost`)
- **package** `windows`
- **source** `bundle/windows/WindowsScriptHost.php`

**Description**

Методы класса позволяют вызывать функции API Windows, выполнять системные скрипты

---

#### Static Methods

- `WindowsScriptHost ::`[`exec()`](#method-exec)
- `WindowsScriptHost ::`[`cmd()`](#method-cmd) - _Выполнить команду_
- `WindowsScriptHost ::`[`WMIC()`](#method-wmic) - _Сделать запрос к WMI_
- `WindowsScriptHost ::`[`PowerShell()`](#method-powershell) - _Выполнить скрипт PowerShell_
- `WindowsScriptHost ::`[`vbScript()`](#method-vbscript) **common.deprecated** - _Выполнить скрипт vbScript (должен располагаться в одну строку)_

---
# Static Methods

<a name="method-exec"></a>

### exec()
```php
WindowsScriptHost::exec(mixed $cmd, mixed $wait, mixed $charset): void
```

---

<a name="method-cmd"></a>

### cmd()
```php
WindowsScriptHost::cmd(string $command, mixed $params, string $charset, string $decodeCharset): string
```
Выполнить команду

---

<a name="method-wmic"></a>

### WMIC()
```php
WindowsScriptHost::WMIC(string $query): array
```
Сделать запрос к WMI

---

<a name="method-powershell"></a>

### PowerShell()
```php
WindowsScriptHost::PowerShell(string $query, array $params, bool $wait): string
```
Выполнить скрипт PowerShell

---

<a name="method-vbscript"></a>

### vbScript()
```php
WindowsScriptHost::vbScript(string $query, string $params): string
```
Выполнить скрипт vbScript (должен располагаться в одну строку)