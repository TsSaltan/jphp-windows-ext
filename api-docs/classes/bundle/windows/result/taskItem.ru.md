# taskItem

- **класс** `taskItem` (`bundle\windows\result\taskItem`) **унаследован от** [`abstractItem`](classes/bundle/windows/result/abstractItem.ru.md)
- **исходники** `bundle/windows/result/taskItem.php`

**Описание**

Экземпляр данного класса содержит информацию об одном процессе

---

#### Свойства

- `->`[`name`](#prop-name) : `string` - _Имя процесса_
- `->`[`pid`](#prop-pid) : `int` - _Process ID_
- `->`[`sessionName`](#prop-sessionname) : `string` - _Имя сессии_
- `->`[`sessionNumber`](#prop-sessionnumber) : `int` - _№ сеанса_
- `->`[`memory`](#prop-memory) : `int` - _Память (в байтах)_
- `->`[`status`](#prop-status) : `string` - _Состояние_
- `->`[`user`](#prop-user) : `string` - _Пользователь_
- `->`[`cpuTime`](#prop-cputime) : `int` - _Время ЦП (сек)_
- `->`[`title`](#prop-title) : `string` - _Заголовок окна_
- *См. также в родительском классе* [abstractItem](classes/bundle/windows/result/abstractItem.ru.md).

---

#### Методы

- `->`[`__construct()`](#method-__construct)
- `->`[`kill()`](#method-kill) - _Завершить процесс_
- См. также в родительском классе [abstractItem](classes/bundle/windows/result/abstractItem.ru.md)

---
# Методы

<a name="method-__construct"></a>

### __construct()
```php
__construct(mixed $name, mixed $pid, mixed $sessionName, mixed $sessionNumber, mixed $memory, mixed $status, mixed $user, mixed $cpuTime, mixed $title): void
```

---

<a name="method-kill"></a>

### kill()
```php
kill(): void
```
Завершить процесс