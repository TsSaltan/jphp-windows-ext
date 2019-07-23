# Windows

- **класс** `Windows` (`bundle\windows\Windows`)
- **пакет** `windows`
- **исходники** `bundle/windows/Windows.php`

---

#### Свойства

- `->`[`bootupTime`](#prop-bootuptime) : `int` - _Количество миллисекунд с момента запуска системы_

---

#### Статичные Методы

- `Windows ::`[`expandEnv()`](#method-expandenv) - _Раскрывает системные переменные (%TEMP%, %APPDATA% и т.д.)_
- `Windows ::`[`isWin()`](#method-iswin) - _Проверить, относится ли текущая система к семейству OS Windows_
- `Windows ::`[`isAdmin()`](#method-isadmin) - _Проверить, запущена ли программа от имени администратора_
- `Windows ::`[`runAsAdmin()`](#method-runasadmin) - _Запустить процесс от имени администратора_
- `Windows ::`[`requireAdmin()`](#method-requireadmin) - _Перезапускает текущую программу с требованием прав администратора_
- `Windows ::`[`getArch()`](#method-getarch) - _Получить разрядность системы_
- `Windows ::`[`getTemp()`](#method-gettemp) - _Получить путь ко временной папке_
- `Windows ::`[`getUsers()`](#method-getusers) - _Получить список пользователей на данном ПК_
- `Windows ::`[`getDriveSerial()`](#method-getdriveserial) - _Получить серийный номер носителя_
- `Windows ::`[`getDrives()`](#method-getdrives) - _Получить список подключенных дисков и их характеристик_
- `Windows ::`[`getOS()`](#method-getos) - _Получить характеристики операционной системы_
- `Windows ::`[`getMotherboard()`](#method-getmotherboard) - _Получить характеристики материнской платы_
- `Windows ::`[`getMotherboardSerial()`](#method-getmotherboardserial) - _Получить серийный номер материнской платы_
- `Windows ::`[`getMotherboardManufacturer()`](#method-getmotherboardmanufacturer) - _Получить производителя материнской платы_
- `Windows ::`[`getMotherboardProduct()`](#method-getmotherboardproduct) - _Получить модель материнской платы_
- `Windows ::`[`getCpuVoltage()`](#method-getcpuvoltage) - _Получить вольтаж процессора_
- `Windows ::`[`getCpuManufacturer()`](#method-getcpumanufacturer) - _Получить производителя процессора_
- `Windows ::`[`getCpuFrequency()`](#method-getcpufrequency) - _Получить максимальную частоту процессора_
- `Windows ::`[`getCpuSerial()`](#method-getcpuserial) - _Получить серийный номер процессора_
- `Windows ::`[`getCpuProduct()`](#method-getcpuproduct) - _Получить модель процессора_
- `Windows ::`[`getCPU()`](#method-getcpu) - _Получить характеристики процессора_
- `Windows ::`[`getVideoProduct()`](#method-getvideoproduct) - _Получить модель (первой) видеокарты_
- `Windows ::`[`getVideoManufacturer()`](#method-getvideomanufacturer) - _Получить производителя (первой) видеокарты_
- `Windows ::`[`getVideoRAM()`](#method-getvideoram) - _Получить память (первой) видеокарты_
- `Windows ::`[`getVideoMode()`](#method-getvideomode) - _Получить разрешение (первой) видеокарты_
- `Windows ::`[`getVideo()`](#method-getvideo) - _Получить характеристики всех подключенных видеокарт_
- `Windows ::`[`getSound()`](#method-getsound) - _Получить характеристики звуковых устройств_
- `Windows ::`[`getRAM()`](#method-getram) - _Получить характеристики устройств оперативной памяти_
- `Windows ::`[`getTotalRAM()`](#method-gettotalram) - _Получить полный объем оперативной памяти (в байтах)_
- `Windows ::`[`getFreeRAM()`](#method-getfreeram) - _Получить объем свободной оперативной памяти (в байтах)_
- `Windows ::`[`getUUID()`](#method-getuuid) - _Получить уникальный UUID системы_
- `Windows ::`[`getBIOS()`](#method-getbios) - _Получить информацию о BIOS_
- `Windows ::`[`getPrinter()`](#method-getprinter) - _Получить массив принтеров и их характеристики_
- `Windows ::`[`getProductName()`](#method-getproductname) - _Получить ProductName системы_
- `Windows ::`[`getMAC()`](#method-getmac) - _Получить MAC-адрес сетевой карты_
- `Windows ::`[`getTemperature()`](#method-gettemperature) - _Получить температуру с датчиков (желательно запускать с парвами администратора)_
- `Windows ::`[`getBootUptime()`](#method-getbootuptime) - _Получить время запуска системы_
- `Windows ::`[`getUptime()`](#method-getuptime) - _Получить время работы системы_
- `Windows ::`[`getBatteryInfo()`](#method-getbatteryinfo) - _Получить данные о встроенной батарее_
- `Windows ::`[`getBatteryTimeRemaining()`](#method-getbatterytimeremaining) - _Получить предположительное оставшееся время работы._
- `Windows ::`[`getBatteryPercent()`](#method-getbatterypercent) - _Получить процент заряда батареи_
- `Windows ::`[`getBatteryVoltage()`](#method-getbatteryvoltage) - _Получить напряжение батареи_
- `Windows ::`[`isBatteryCharging()`](#method-isbatterycharging) - _Находится ли батарея на зарядке_
- `Windows ::`[`createShortcut()`](#method-createshortcut) - _Создать lnk-ярлык (ссылку на файл)_
- `Windows ::`[`getShortcutTarget()`](#method-getshortcuttarget) - _Получить ссылку на файл lnk-ярлыка_
- `Windows ::`[`speak()`](#method-speak) **common.deprecated** - _Проговорить текст_
- `Windows ::`[`setBrightnessLevel()`](#method-setbrightnesslevel) - _Установить уровень яркости (Windows 10 only)_
- `Windows ::`[`getBrightnessLevel()`](#method-getbrightnesslevel) - _Получить уровень яркости (Windows 10 only)_
- `Windows ::`[`setVolumeLevel()`](#method-setvolumelevel) - _Установить уровень громкости (Windows 10 only)_
- `Windows ::`[`getVolumeLevel()`](#method-getvolumelevel) - _Получить уровень громкости (Windows 10 only)_
- `Windows ::`[`setMute()`](#method-setmute) - _Включить / выключить режим "без звука"_
- `Windows ::`[`getMute()`](#method-getmute) - _Проверить, включен ли режим "без звука"_
- `Windows ::`[`psAudioQuery()`](#method-psaudioquery)
- `Windows ::`[`setTime()`](#method-settime) - _Установить системное время (нужны права администратора)_
- `Windows ::`[`setDate()`](#method-setdate) - _Установить системную дату (нужны права администратора)_
- `Windows ::`[`extractIcon()`](#method-extracticon) - _Извлекает и сохраняет отображаемую в проводнике иконку файла_
- `Windows ::`[`getWallpaperPath()`](#method-getwallpaperpath) - _Получить системный путь, по которому расположено изображение с обоями_
- `Windows ::`[`getWallpaper()`](#method-getwallpaper) - _Получить изображение с текущими обоями_
- `Windows ::`[`setWallpaper()`](#method-setwallpaper) - _Установить обои_
- `Windows ::`[`updateDesktopWallpaper()`](#method-updatedesktopwallpaper) - _Визуальное обновление обоев на рабочем столе_
- `Windows ::`[`getSystem32()`](#method-getsystem32) - _Путь к системной папке windows\system32_
- `Windows ::`[`getSystemDrive()`](#method-getsystemdrive) - _Возвращает букву системного диска_
- `Windows ::`[`getSysNative()`](#method-getsysnative) - _Если 32-битный процесс запущен в 64-битной системе, то он не может_
- `Windows ::`[`ping()`](#method-ping) - _Ping_
- `Windows ::`[`isInternetAvaliable()`](#method-isinternetavaliable) - _Проверить наличие Интернет-соединения_
- `Windows ::`[`getKeyboardLayout()`](#method-getkeyboardlayout) - _Получить код раскладки клавиатуры_
- `Windows ::`[`getKeyboardLayoutName()`](#method-getkeyboardlayoutname) - _Получить название раскладки клавиатуры_
- `Windows ::`[`getProductKey()`](#method-getproductkey) - _Возвращает ProductKey системы_
- `Windows ::`[`getProductVersion()`](#method-getproductversion) - _Возвращает номер версии ОС_
- `Windows ::`[`getProductBuild()`](#method-getproductbuild) - _Возвращает номер сборки ОС_
- `Windows ::`[`pressKey()`](#method-presskey) - _Имитирует нажатие на кнопку_
- `Windows ::`[`shutdown()`](#method-shutdown) - _Выключить ПК_
- `Windows ::`[`reboot()`](#method-reboot) - _Перезагрузить ПК_

---
# Статичные Методы

<a name="method-expandenv"></a>

### expandEnv()
```php
Windows::expandEnv(string $string): string
```
Раскрывает системные переменные (%TEMP%, %APPDATA% и т.д.)

---

<a name="method-iswin"></a>

### isWin()
```php
Windows::isWin(): bool
```
Проверить, относится ли текущая система к семейству OS Windows

---

<a name="method-isadmin"></a>

### isAdmin()
```php
Windows::isAdmin(): bool
```
Проверить, запущена ли программа от имени администратора

---

<a name="method-runasadmin"></a>

### runAsAdmin()
```php
Windows::runAsAdmin(string $file, array $args, string $workDir): void
```
Запустить процесс от имени администратора

---

<a name="method-requireadmin"></a>

### requireAdmin()
```php
Windows::requireAdmin(): void
```
Перезапускает текущую программу с требованием прав администратора

---

<a name="method-getarch"></a>

### getArch()
```php
Windows::getArch(): string
```
Получить разрядность системы

---

<a name="method-gettemp"></a>

### getTemp()
```php
Windows::getTemp(): string
```
Получить путь ко временной папке

---

<a name="method-getusers"></a>

### getUsers()
```php
Windows::getUsers(): array
```
Получить список пользователей на данном ПК

---

<a name="method-getdriveserial"></a>

### getDriveSerial()
```php
Windows::getDriveSerial(string $drive): string
```
Получить серийный номер носителя

---

<a name="method-getdrives"></a>

### getDrives()
```php
Windows::getDrives(): array
```
Получить список подключенных дисков и их характеристик

---

<a name="method-getos"></a>

### getOS()
```php
Windows::getOS(): array
```
Получить характеристики операционной системы

---

<a name="method-getmotherboard"></a>

### getMotherboard()
```php
Windows::getMotherboard(): string
```
Получить характеристики материнской платы

---

<a name="method-getmotherboardserial"></a>

### getMotherboardSerial()
```php
Windows::getMotherboardSerial(): string
```
Получить серийный номер материнской платы

---

<a name="method-getmotherboardmanufacturer"></a>

### getMotherboardManufacturer()
```php
Windows::getMotherboardManufacturer(): string
```
Получить производителя материнской платы

---

<a name="method-getmotherboardproduct"></a>

### getMotherboardProduct()
```php
Windows::getMotherboardProduct(): string
```
Получить модель материнской платы

---

<a name="method-getcpuvoltage"></a>

### getCpuVoltage()
```php
Windows::getCpuVoltage(): string
```
Получить вольтаж процессора

---

<a name="method-getcpumanufacturer"></a>

### getCpuManufacturer()
```php
Windows::getCpuManufacturer(): string
```
Получить производителя процессора

---

<a name="method-getcpufrequency"></a>

### getCpuFrequency()
```php
Windows::getCpuFrequency(): string
```
Получить максимальную частоту процессора

---

<a name="method-getcpuserial"></a>

### getCpuSerial()
```php
Windows::getCpuSerial(): string
```
Получить серийный номер процессора

---

<a name="method-getcpuproduct"></a>

### getCpuProduct()
```php
Windows::getCpuProduct(): string
```
Получить модель процессора

---

<a name="method-getcpu"></a>

### getCPU()
```php
Windows::getCPU(): string
```
Получить характеристики процессора

---

<a name="method-getvideoproduct"></a>

### getVideoProduct()
```php
Windows::getVideoProduct(): string
```
Получить модель (первой) видеокарты

---

<a name="method-getvideomanufacturer"></a>

### getVideoManufacturer()
```php
Windows::getVideoManufacturer(): string
```
Получить производителя (первой) видеокарты

---

<a name="method-getvideoram"></a>

### getVideoRAM()
```php
Windows::getVideoRAM(): string
```
Получить память (первой) видеокарты

---

<a name="method-getvideomode"></a>

### getVideoMode()
```php
Windows::getVideoMode(): string
```
Получить разрешение (первой) видеокарты

---

<a name="method-getvideo"></a>

### getVideo()
```php
Windows::getVideo(): string
```
Получить характеристики всех подключенных видеокарт

---

<a name="method-getsound"></a>

### getSound()
```php
Windows::getSound(): string
```
Получить характеристики звуковых устройств

---

<a name="method-getram"></a>

### getRAM()
```php
Windows::getRAM(): array
```
Получить характеристики устройств оперативной памяти

---

<a name="method-gettotalram"></a>

### getTotalRAM()
```php
Windows::getTotalRAM(): int
```
Получить полный объем оперативной памяти (в байтах)

---

<a name="method-getfreeram"></a>

### getFreeRAM()
```php
Windows::getFreeRAM(): int
```
Получить объем свободной оперативной памяти (в байтах)

---

<a name="method-getuuid"></a>

### getUUID()
```php
Windows::getUUID(): string
```
Получить уникальный UUID системы

---

<a name="method-getbios"></a>

### getBIOS()
```php
Windows::getBIOS(): array
```
Получить информацию о BIOS

---

<a name="method-getprinter"></a>

### getPrinter()
```php
Windows::getPrinter(): array
```
Получить массив принтеров и их характеристики

---

<a name="method-getproductname"></a>

### getProductName()
```php
Windows::getProductName(): string
```
Получить ProductName системы

---

<a name="method-getmac"></a>

### getMAC()
```php
Windows::getMAC(): string
```
Получить MAC-адрес сетевой карты

---

<a name="method-gettemperature"></a>

### getTemperature()
```php
Windows::getTemperature(): array
```
Получить температуру с датчиков (желательно запускать с парвами администратора)

---

<a name="method-getbootuptime"></a>

### getBootUptime()
```php
Windows::getBootUptime(): int
```
Получить время запуска системы

---

<a name="method-getuptime"></a>

### getUptime()
```php
Windows::getUptime(): int
```
Получить время работы системы

---

<a name="method-getbatteryinfo"></a>

### getBatteryInfo()
```php
Windows::getBatteryInfo(): array
```
Получить данные о встроенной батарее

---

<a name="method-getbatterytimeremaining"></a>

### getBatteryTimeRemaining()
```php
Windows::getBatteryTimeRemaining(): int
```
Получить предположительное оставшееся время работы.

---

<a name="method-getbatterypercent"></a>

### getBatteryPercent()
```php
Windows::getBatteryPercent(): int
```
Получить процент заряда батареи

---

<a name="method-getbatteryvoltage"></a>

### getBatteryVoltage()
```php
Windows::getBatteryVoltage(): int
```
Получить напряжение батареи

---

<a name="method-isbatterycharging"></a>

### isBatteryCharging()
```php
Windows::isBatteryCharging(): bool
```
Находится ли батарея на зарядке

---

<a name="method-createshortcut"></a>

### createShortcut()
```php
Windows::createShortcut(string $shortcut, string $target, mixed $description): void
```
Создать lnk-ярлык (ссылку на файл)

---

<a name="method-getshortcuttarget"></a>

### getShortcutTarget()
```php
Windows::getShortcutTarget(string $shortcut): string
```
Получить ссылку на файл lnk-ярлыка

---

<a name="method-speak"></a>

### speak()
```php
Windows::speak(string $text): void
```
Проговорить текст

---

<a name="method-setbrightnesslevel"></a>

### setBrightnessLevel()
```php
Windows::setBrightnessLevel(int $level, mixed $time): void
```
Установить уровень яркости (Windows 10 only)

---

<a name="method-getbrightnesslevel"></a>

### getBrightnessLevel()
```php
Windows::getBrightnessLevel(): int
```
Получить уровень яркости (Windows 10 only)

---

<a name="method-setvolumelevel"></a>

### setVolumeLevel()
```php
Windows::setVolumeLevel(int $level): void
```
Установить уровень громкости (Windows 10 only)

---

<a name="method-getvolumelevel"></a>

### getVolumeLevel()
```php
Windows::getVolumeLevel(): int
```
Получить уровень громкости (Windows 10 only)

---

<a name="method-setmute"></a>

### setMute()
```php
Windows::setMute(bool $value): void
```
Включить / выключить режим "без звука"

---

<a name="method-getmute"></a>

### getMute()
```php
Windows::getMute(): bool
```
Проверить, включен ли режим "без звука"

---

<a name="method-psaudioquery"></a>

### psAudioQuery()
```php
Windows::psAudioQuery(mixed $key, mixed $value): void
```

---

<a name="method-settime"></a>

### setTime()
```php
Windows::setTime(mixed $time): void
```
Установить системное время (нужны права администратора)

---

<a name="method-setdate"></a>

### setDate()
```php
Windows::setDate(mixed $date): void
```
Установить системную дату (нужны права администратора)

---

<a name="method-extracticon"></a>

### extractIcon()
```php
Windows::extractIcon(string $file, string $icon): boolean
```
Извлекает и сохраняет отображаемую в проводнике иконку файла

---

<a name="method-getwallpaperpath"></a>

### getWallpaperPath()
```php
Windows::getWallpaperPath(): string
```
Получить системный путь, по которому расположено изображение с обоями

---

<a name="method-getwallpaper"></a>

### getWallpaper()
```php
Windows::getWallpaper(): php\gui\UXImage
```
Получить изображение с текущими обоями

---

<a name="method-setwallpaper"></a>

### setWallpaper()
```php
Windows::setWallpaper(string|UXImage $image): void
```
Установить обои

---

<a name="method-updatedesktopwallpaper"></a>

### updateDesktopWallpaper()
```php
Windows::updateDesktopWallpaper(): void
```
Визуальное обновление обоев на рабочем столе
(вместо перезапуска explorer'a)

---

<a name="method-getsystem32"></a>

### getSystem32()
```php
Windows::getSystem32(mixed $path): string
```
Путь к системной папке windows\system32

---

<a name="method-getsystemdrive"></a>

### getSystemDrive()
```php
Windows::getSystemDrive(): string
```
Возвращает букву системного диска

---

<a name="method-getsysnative"></a>

### getSysNative()
```php
Windows::getSysNative(mixed $path): string
```
Если 32-битный процесс запущен в 64-битной системе, то он не может
запустить 64 битный powershell, для этого монтируется виртуальная
директория SysNative, если запустить оттуда, запущенный процесс будет 64-битный

---

<a name="method-ping"></a>

### ping()
```php
Windows::ping(string $domain, int $count, int $length): array
```
Ping

---

<a name="method-isinternetavaliable"></a>

### isInternetAvaliable()
```php
Windows::isInternetAvaliable(): bool
```
Проверить наличие Интернет-соединения

---

<a name="method-getkeyboardlayout"></a>

### getKeyboardLayout()
```php
Windows::getKeyboardLayout(): string
```
Получить код раскладки клавиатуры

---

<a name="method-getkeyboardlayoutname"></a>

### getKeyboardLayoutName()
```php
Windows::getKeyboardLayoutName(): string
```
Получить название раскладки клавиатуры

---

<a name="method-getproductkey"></a>

### getProductKey()
```php
Windows::getProductKey(): string
```
Возвращает ProductKey системы

---

<a name="method-getproductversion"></a>

### getProductVersion()
```php
Windows::getProductVersion(): int
```
Возвращает номер версии ОС

---

<a name="method-getproductbuild"></a>

### getProductBuild()
```php
Windows::getProductBuild(): int
```
Возвращает номер сборки ОС

---

<a name="method-presskey"></a>

### pressKey()
```php
Windows::pressKey(int $keyCode): void
```
Имитирует нажатие на кнопку

---

<a name="method-shutdown"></a>

### shutdown()
```php
Windows::shutdown(): void
```
Выключить ПК

---

<a name="method-reboot"></a>

### reboot()
```php
Windows::reboot(): void
```
Перезагрузить ПК