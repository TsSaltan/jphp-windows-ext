@echo off

rem В формате csv выводит список процессов
tasklist /FO CSV /NH > "$outPath"