@echo off
rem more убирает "левые" байты, которые мешали нормально распарсить ответ (Thanks: http://superuser.com/questions/812438/combine-batch-wmic-ansi-unicode-output-formatting)
WMIC $query /Format:List | more > "$outPath"