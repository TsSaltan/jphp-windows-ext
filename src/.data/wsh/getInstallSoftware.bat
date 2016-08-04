@ECHO OFF
:: Вывод списка установленных программ
CHCP 1251 > nul
SET UNISTALL=HKLM\Software\Microsoft\Windows\CurrentVersion\Uninstall
FOR /f "tokens=7 delims=\" %%a IN ('reg query "%UNISTALL%"') DO (
        FOR /f "tokens=1,2,*" %%b IN ('reg query "%UNISTALL%\%%a" ^| FIND /I "DisplayName"') DO (
                ECHO %%d
        )
)