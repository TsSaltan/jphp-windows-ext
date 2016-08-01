@echo off
chcp 866>nul
color 70
title ‚­Ё¬ ­ЁҐ! ‘ўҐ¤Ґ­Ёп ¬®Јгв Ўлвм ­Ґ в®з­л¬Ё!
echo.
echo ЃЁ®б
echo __________________________
For /F "tokens=2 Delims==" %%J In ('wmic bios get caption /Value^|FindStr .') Do echo Ќ §ў ­ЁҐ: %%J
echo.
echo ЋЇҐа жЁ®­­ п бЁбвҐ¬ 
echo __________________________
if defined ProgramFiles(x86) (set oper=x64) else (set oper=x32)
FOR /F "tokens=1* delims==" %%A IN ('wmic os get caption /Format:List ^| FIND "="') DO set "s=%%~B"
echo Ќ §ў ­ЁҐ: %s% %oper%
For /F "tokens=2 Delims==" %%J In ('wmic os get buildnumber /Value^|FindStr .') Do echo Ќ®¬Ґа бЎ®аЄЁ: %%J
For /F "tokens=2 Delims==" %%J In ('wmic os get systemdrive /Value^|FindStr .') Do echo “бв ­®ў«Ґ­  ­  ¤ЁбЄҐ: %%J
wmic os get servicepackmajorversion | 1>nul findstr "0" && echo ‘ҐаўЁб Ї Є: ЌҐ гбв ­®ў«Ґ­ || (
For /F "tokens=2 Delims==" %%J In ('wmic os get servicepackmajorversion /Value^|FindStr .') Do echo ‘ҐаўЁб Ї Є: %%J
)
echo Џ®«м§®ў вҐ«м: %username%
For /F "tokens=2 Delims==" %%J In ('wmic os get numberofusers /Value^|FindStr .') Do echo Љ®«ЁзҐбвў® Ї®«м§®ў вҐ«Ґ©: %%J
For /F "tokens=2 Delims==" %%J In ('wmic computersystem get domain /Value^|FindStr .') Do echo ђ Ў®з п ЈагЇЇ : %%J
echo.
echo Њ вҐаЁ­бЄ п Ї« в 
echo __________________________
For /F "tokens=2 Delims==" %%J In ('WMIC baseboard get manufacturer /Value^|FindStr .') Do echo Ќ §ў ­ЁҐ: %%J
For /F "tokens=2 Delims==" %%J In ('WMIC baseboard get product /Value^|FindStr .') Do echo Њ®¤Ґ«м: %%J
echo.
echo Џа®жҐбб®а
echo __________________________
For /F "tokens=2 Delims==" %%J In ('wmic computersystem get numberofprocessors /Value^|FindStr .') Do echo Љ®«ЁзҐбвў® Їа®жҐбб®а®ў: %%J
For /F "tokens=2 Delims==" %%J In ('WMIC CPU Get Name /Value^|FindStr .') Do echo Ќ §ў ­ЁҐ: %%J
FOR /F "tokens=1* delims==" %%A IN ('WMIC CPU Get currentclockspeed /Format:List ^| FIND "="') DO set "s=%%~B"
echo — бв®в : %s% ЊЈж
FOR /F "tokens=1* delims==" %%A IN ('WMIC CPU Get maxclockspeed /Format:List ^| FIND "="') DO set "s=%%~B"
echo Њ ЄбЁ¬ «м­ п з бв®в : %s% ЊЈж
set cachelevel=2
set cachelevelrus=ўв®а®Ј®
call :cache
set cachelevel=3
set cachelevelrus=ваҐвмҐЈ®
call :cache
goto 1
:cache
FOR /F "tokens=1* delims==" %%A IN ('WMIC CPU Get l%cachelevel%cachesize /Format:List ^| FIND "="') DO set "su=%%~B"
call :mbgb
if %su% GTR 1024 set /a su=%su%/1000
echo Љни %cachelevelrus% га®ў­п: %su% %uu%
exit /b
:1
FOR /F "tokens=1* delims==" %%A IN ('WMIC CPU Get numberofcores /Format:List ^| FIND "="') DO set "s=%%~B"
FOR /F "tokens=1* delims==" %%A IN ('WMIC CPU Get numberoflogicalprocessors /Format:List ^| FIND "="') DO set "ss=%%~B"
echo џ¤Ґа: %s% Џ®в®Є®ў: %ss%
echo.
echo ‚Ё¤Ґ®Є ав 
echo __________________________
set /a numik=0
FOR /F "tokens=1* delims==" %%A IN ('WMIC Path Win32_VideoController get AdapterRAM /Format:List ^| FIND "="') DO set "s=%%~B" & call :vdo
goto 2
:vdo
set /a numik=%numik%+1
set /a sss=%s%/1024/1024
echo ‚Ё¤Ґ®Ї ¬пвм %numik%: %sss% ЊЎ
exit /b
:2
set /a num=0
for /F "tokens=1* delims==" %%A IN ('WMIC Path Win32_VideoController get Name /Format:List ^| FIND "="') DO set "s=%%~B" & call :vdol
goto 3
:vdol
set /a num=%num%+1
echo ‚Ё¤Ґ®Є ав  %num%: %s%
exit /b
:3
for /F "tokens=2 delims==" %%A IN ('WMIC Path Win32_VideoController get currenthorizontalresolution /Format:List ^| FIND "="') DO call :hor "%%A"
:hor
if not "%~1"=="" set hh=%~1
for /F "tokens=2 delims==" %%A IN ('WMIC Path Win32_VideoController get currentverticalresolution /Format:List ^| FIND "="') DO call :ver "%%A"
:ver
if not "%~1"=="" set vv=%~1
echo ’ҐЄгйҐҐ а §аҐиҐ­ЁҐ: %hh% x %vv%
echo.
echo ‡ўгЄ®ў п Є ав 
echo __________________________
set /a num=0
FOR /F "tokens=1* delims==" %%A IN ('WMIC sounddev get Name /Format:List ^| FIND "="') DO set "s=%%~B" & call :vdol
goto 3
:vdol
set /a num=%num%+1
echo Ќ §ў ­ЁҐ гбва®©бвў : %num%: %s%
exit /b
:3
echo.
echo ЋЇҐа вЁў­ п Ї ¬пвм
echo __________________________
set /a num=0
FOR /F "tokens=1* delims==" %%A IN ('WMIC memorychip get capacity /Format:List ^| FIND "="') DO set "s=%%~B" & call :vdols
goto 33
:vdols
set /a num=%num%+1
echo ‘«®в Ї ¬пвЁ: %num%: %s% Ў
exit /b
:33
FOR /F "tokens=1* delims==" %%A IN ('WMIC os get totalvisiblememorysize /Format:List ^| FIND "="') DO set "su=%%~B" & call :vdod
goto 4
:vdod
call :mbgb
goto after
:mbgb
if %su% LSS 1 (set uu=Ў) else if %su% LSS 1024 (set uu=ЉЎ) else if %su% GTR 1024 set uu=ЊЎ
exit /b
:after
set /a sss=%su%/1024
echo „®бвгЇ­®: %sss% %uu%
exit /b
:4
for /F "tokens=2 Delims==" %%J In ('WMIC memphysical get memorydevices /Value^|FindStr .') Do echo ‘«®в®ў ¤«п Ї ¬пвЁ: %%J
echo.
echo ЏҐаҐ­®б­лҐ гбва®©бвў 
echo __________________________
For /F "tokens=2 Delims==" %%J In ('WMIC cdrom get id /Value^|FindStr .') Do echo „ЁбЄ: %%J
For /F "tokens=2 Delims==" %%J In ('WMIC cdrom get volumename /Value^|FindStr .') Do echo Ќ §ў ­ЁҐ: %%J
Pause >nul
exit