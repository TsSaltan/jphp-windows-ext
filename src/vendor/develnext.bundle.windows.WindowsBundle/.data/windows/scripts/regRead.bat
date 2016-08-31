@echo off
reg query "$path" /v "$key" > "$outPath"