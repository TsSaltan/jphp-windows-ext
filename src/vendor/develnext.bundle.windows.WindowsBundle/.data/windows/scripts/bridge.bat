@echo off
rem "Мост" для выполнения js/vbs скриптов
for /f "tokens=*" %%i in ('cscript /nologo "$scrPath"') do set return=%%i
echo %return% > "$outPath"