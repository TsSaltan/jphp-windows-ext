@echo off
rem "Мост" для выполнения js/vbs скриптов
for /f "tokens=*" %%i in ('cscript /nologo "$scriptPath"') do set return=%%i
echo %return% > "$outPath"