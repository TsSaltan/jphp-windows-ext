@@ -1,213 +0,0 @@
## DevelNext Windows Module
Добавляет функционал для работы с системными функциями ОС Windows. Включает в себя: работу с реестром, получение характеристик железа, работу с автозапуском и т.д.

#### Функции
```php
/**
 * --RU--
 * Проверить, относится ли текущая система к семейству OS Windows
 * @return bool
 */
public static function isWin();

/**
 * --RU--
 * Получить путь ко временной папке
 * @return string
 */
public static function getTemp();

/**
 * --RU--
 * Очистить временную папку
 */
public static function clearTemp();

/**
 * --RU--
 * Получить массив запущенных процессов
 * @return array( [process, id, session, sessionNumber, memory], ...)
 */
public static function getTasklist();

/**
 * --RU--
 * Завершить процесс по его имени
 */
public static function taskKill($procName);

/**
 * --RU--
 * Проверить, запущен ли процесс
 */
public static function taskExists($procName);

/**
 * --RU--
 * Получить сериальный номер носителя
 * @param string $drive - Буква диска
 * @return string
 */
public static function getDriveSerial($drive);

/**
 * --RU--
 * Получить всю информацию об оперативной системе
 * @return string
 */
public static function getOS();

/**
 * --RU--
 * Получить всю информацию о материнской плате
 * @return string
 */
public static function getMotherboard();

/**
 * --RU--
 * Получить сериальный номер материнской платы
 * @return string
 */
public static function getMotherboardSerial();

/**
 * --RU--
 * Получить производителя материнской платы
 * @return string
 */
public static function getMotherboardManufacturer();

/**
 * --RU--
 * Получить модель материнской платы
 * @return string
 */
public static function getMotherboardProduct();

/**
 * --RU--
 * Получить вольтаж процессора
 * @return string
 */
public static function getCpuVoltage();

/**
 * --RU--
 * Получить производителя процессора
 * @return string
 */
public static function getCpuManufacturer();

/**
 * --RU--
 * Получить частоту процессора
 * @return string
 */
public static function getCpuFrequency();

/**
 * --RU--
 * Получить серийный номер процессора
 * @return string
 */
public static function getCpuSerial();

/**
 * --RU--
 * Получить модель процессора
 * @return string
 */
public static function getCpuProduct();

/**
 * --RU--
 * Получить информацию о процессоре
 * @return string
 */
public static function getCPU();

/**
 * --RU--
 * Получить модель (первой) видеокарты
 * @return string
 */
public static function getVideoProduct();

/**
 * --RU--
 * Получить производителя (первой) видеокарты
 * @return string
 */
public static function getVideoManufacturer();

/**
 * --RU--
 * Получить память (первой) видеокарты
 * @return string
 */
public static function getVideoRAM();

/**
 * --RU--
 * Получить разрешение (первой) видеокарты
 * @return string
 */
public static function getVideoMode();

/**
 * --RU--
 * Получить всю информацию о видеокартах
 * @return string
 */
public static function getVideo();

/**
 * --RU--
 * Получить уникальный UUID системы
 * @return string
 */
public static function getUUID();

/**
 * --RU--
 * Прочитать параметр из реестра
 * @param string $path - Путь раздела
 * @param string $key - Имя параметра, по умолчанию "*" - все параметры
 * @return mixed (string - если 1 параметр, array - если несколько параметров)
 */
public static function regRead($path, $key);

/**
 * --RU--
 * Удалить параметр из реестра
 * @param string $path - Путь раздела
 * @param string $key - Имя параметра
 */
public static function regDelete($path, $key);

/**
 * --RU--
 * Добавить новый параметр в реестр
 * @param string $path - Путь раздела
 * @param string $key - Имя параметра
 * @param string $value - Значение
 * @param string $type - Тип пременной (REG_SZ|REG_DWORD|REG_BINARY)
 */
public static function regAdd($path, $key, $value, $type);

/**
 * --RU--
 * Добавить программу в автозагрузку
 * @param string $path - Путь к исполняющему файлу
 */
public static function startupAdd($path);

/**
 * --RU--
 * Удалить программу из автозагрузки
 * @param string $path - Путь к исполняющему файлу
 */
public static function startupDelete($path);

```