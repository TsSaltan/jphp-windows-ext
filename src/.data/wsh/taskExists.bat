@echo off
rem Проверяет, запущен ли определенный процесс. 0 - запущен, 1 - не запущен
tasklist /fi "imagename eq "$process"" | find /i "$process" > nul
echo %errorlevel%  > "$outPath"