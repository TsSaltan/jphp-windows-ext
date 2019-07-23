# Task

- **класс** `Task` (`bundle\windows\Task`)
- **пакет** `windows`
- **исходники** `bundle/windows/Task.php`

---

#### Статичные Методы

- `Task ::`[`getList()`](#method-getlist) - _Получить список процессов_
- `Task ::`[`findByPID()`](#method-findbypid) - _Поиск процесса по PID_
- `Task ::`[`find()`](#method-find) - _Поиск процесса по имени образа_
- `Task ::`[`findByTitle()`](#method-findbytitle) - _Поиск процесса по заголовку окна_
- `Task ::`[`exists()`](#method-exists) - _Существует ли процесс с таким именем образа_
- `Task ::`[`pidExists()`](#method-pidexists) - _Существует ли процесс с таким PID_
- `Task ::`[`titleExists()`](#method-titleexists) - _Существует ли процесс с таким заголовком окна_
- `Task ::`[`exec()`](#method-exec)
- `Task ::`[`parseAnswer()`](#method-parseanswer)

---
# Статичные Методы

<a name="method-getlist"></a>

### getList()
```php
Task::getList(): \result\taskResult
```
Получить список процессов

---

<a name="method-findbypid"></a>

### findByPID()
```php
Task::findByPID(int $pid): \result\taskItem
```
Поиск процесса по PID

---

<a name="method-find"></a>

### find()
```php
Task::find(string $name): \result\taskResult
```
Поиск процесса по имени образа

---

<a name="method-findbytitle"></a>

### findByTitle()
```php
Task::findByTitle(string $title): \result\taskResult
```
Поиск процесса по заголовку окна

---

<a name="method-exists"></a>

### exists()
```php
Task::exists(string $name): bool
```
Существует ли процесс с таким именем образа

---

<a name="method-pidexists"></a>

### pidExists()
```php
Task::pidExists(int $pid): bool
```
Существует ли процесс с таким PID

---

<a name="method-titleexists"></a>

### titleExists()
```php
Task::titleExists(string $title): bool
```
Существует ли процесс с таким заголовком окна

---

<a name="method-exec"></a>

### exec()
```php
Task::exec(mixed $filter): void
```

---

<a name="method-parseanswer"></a>

### parseAnswer()
```php
Task::parseAnswer(mixed $list): void
```