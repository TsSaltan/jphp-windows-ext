@echo off
rem more убирает "левые" байты, которые мешали нормально распарсить ответ
WMIC $query /Format:List | more > "$outPath"