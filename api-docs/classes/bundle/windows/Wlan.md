# Wlan

- **class** `Wlan` (`bundle\windows\Wlan`)
- **package** `windows`
- **source** `bundle/windows/Wlan.php`

**Description**

Wireless lan

---

#### Static Methods

- `Wlan ::`[`getInterfaces()`](#method-getinterfaces) - _Получить список интерфейсов_
- `Wlan ::`[`isSupported()`](#method-issupported) - _Есть ли оборудование для работы с беспроводными сетями_
- `Wlan ::`[`getMainInterface()`](#method-getmaininterface) - _Получить используемый беспроводной интерфейс (идёт первый в списке интерфейсов)_

---
# Static Methods

<a name="method-getinterfaces"></a>

### getInterfaces()
```php
Wlan::getInterfaces(): array
```
Получить список интерфейсов

---

<a name="method-issupported"></a>

### isSupported()
```php
Wlan::isSupported(): boolean
```
Есть ли оборудование для работы с беспроводными сетями

---

<a name="method-getmaininterface"></a>

### getMainInterface()
```php
Wlan::getMainInterface(): bundle\windows\result\wlanInterface
```
Получить используемый беспроводной интерфейс (идёт первый в списке интерфейсов)