# taskItem

- **class** `taskItem` (`bundle\windows\result\taskItem`) **extends** [`abstractItem`](classes/bundle/windows/result/abstractItem.md)
- **source** `bundle/windows/result/taskItem.php`

**Description**

Экземпляр данного класса содержит информацию об одном процессе

---

#### Properties

- `->`[`name`](#prop-name) : `string` - _Имя процесса_
- `->`[`pid`](#prop-pid) : `int` - _Process ID_
- `->`[`sessionName`](#prop-sessionname) : `string` - _Имя сессии_
- `->`[`sessionNumber`](#prop-sessionnumber) : `int` - _№ сеанса_
- `->`[`memory`](#prop-memory) : `int` - _Память (в байтах)_
- `->`[`status`](#prop-status) : `string` - _Состояние_
- `->`[`user`](#prop-user) : `string` - _Пользователь_
- `->`[`cpuTime`](#prop-cputime) : `int` - _CPU Time (sec)_
- `->`[`title`](#prop-title) : `string` - _Window Title_
- *See also in the parent class* [abstractItem](classes/bundle/windows/result/abstractItem.md).

---

#### Methods

- `->`[`__construct()`](#method-__construct)
- `->`[`kill()`](#method-kill) - _Завершить процесс_
- See also in the parent class [abstractItem](classes/bundle/windows/result/abstractItem.md)

---
# Methods

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