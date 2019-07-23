# Lan

- **класс** `Lan` (`bundle\windows\Lan`)
- **пакет** `windows`
- **исходники** `bundle/windows/Lan.php`

**Описание**

Local Area Network

---

#### Статичные Методы

- `Lan ::`[`getAdapters()`](#method-getadapters) - _Получить список адаптеров_
- `Lan ::`[`getActiveAdapter()`](#method-getactiveadapter) - _Получить используемый по умолчанию адаптер_
- `Lan ::`[`isSupported()`](#method-issupported) - _Есть ли оборудование для работы с проводными сетями_

---
# Статичные Методы

<a name="method-getadapters"></a>

### getAdapters()
```php
Lan::getAdapters(): array
```
Получить список адаптеров

---

<a name="method-getactiveadapter"></a>

### getActiveAdapter()
```php
Lan::getActiveAdapter(): bundle\windows\result\lanAdapter
```
Получить используемый по умолчанию адаптер

---

<a name="method-issupported"></a>

### isSupported()
```php
Lan::isSupported(): boolean
```
Есть ли оборудование для работы с проводными сетями