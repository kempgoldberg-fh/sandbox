@echo off
:: echo. >NUL 2>test.txt
set /p Input=Enter the project's name:
@echo 127.0.0.1		"%Input%".local >> C:\Windows\System32\drivers\etc\hosts