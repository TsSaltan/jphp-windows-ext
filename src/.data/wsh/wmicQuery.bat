@echo off
WMIC $query /Format:LIST > "$outPath"