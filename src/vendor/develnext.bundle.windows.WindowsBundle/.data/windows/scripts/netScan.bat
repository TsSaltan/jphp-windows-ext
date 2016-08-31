@ECHO OFF
:: Выводит список компов в сети в виде Имя - IP Адрес
FOR /F "tokens=1 delims=\ " %%n IN ('net view^|FIND "\\"') DO (
  FOR /F "tokens=2 delims=[]" %%i IN ('ping -a -n 1 -w 0 %%n^|FIND "["') DO (
    ECHO %%i - %%n  >> "$outPath"
  )
)