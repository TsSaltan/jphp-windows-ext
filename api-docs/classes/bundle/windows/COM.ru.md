# COM

- **класс** `COM` (`bundle\windows\COM`)
- **пакет** `windows`
- **исходники** `bundle/windows/COM.php`

**Описание**

Класс для работы с COM-портами

---

#### Статичные Методы

- `COM ::`[`getList()`](#method-getlist) - _Получить список портов_
- `COM ::`[`getParams()`](#method-getparams) - _Получить список параметров порта_
- `COM ::`[`searchDevice()`](#method-searchdevice) - _Ищет устройство по имени_

---
# Статичные Методы

<a name="method-getlist"></a>

### getList()
```php
COM::getList(): comItem[]
```
Получить список портов

---

<a name="method-getparams"></a>

### getParams()
```php
COM::getParams(string $port): array
```
Получить список параметров порта

---

<a name="method-searchdevice"></a>

### searchDevice()
```php
COM::searchDevice(string $search, mixed $searchFields): comItem[]
```
Ищет устройство по имени