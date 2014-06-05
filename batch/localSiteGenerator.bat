@echo off &setlocal enabledelayedexpansion

set string=var1,var2

:: Request the path to the project
set /p FilePath=Enter File Path: C:/wamp/www/

:: for /f "tokens=* delims=," %%1 in ("%FilePath%") do echo %%1

@echo %string%

set /a count=0
:: for %%i in (%string%) do (
for /f "tokens=* delims=/" %%A in ("%string%") do (
    
)

echo found %count% variables
for /l %%i in (1,1,%count%) do (
    echo variable%%i: !variable%%i!
)

endlocal

::
:: mkdir c:/wamp/www/%FilePath%

:: Request the project name from user...
set /p ProjectName=Enter the project's name:

:: Append new local URL to C:\Windows\System32\drivers\etc\hosts
@echo 127.0.0.1		%ProjectName%.local >> C:\Windows\System32\drivers\etc\hosts

:: Create virtual host for local server
@echo.
@echo ^<VirtualHost *:80^> >> C:\wamp\bin\apache\Apache2.4.4\conf\extra\httpd-vhosts.conf
@echo    DocumentRoot C:/wamp/www/%FilePath% >> C:\wamp\bin\apache\Apache2.4.4\conf\extra\httpd-vhosts.conf
@echo    ServerName %ProjectName%.local >> C:\wamp\bin\apache\Apache2.4.4\conf\extra\httpd-vhosts.conf
@echo ^</VirtualHost^> >> C:\wamp\bin\apache\Apache2.4.4\conf\extra\httpd-vhosts.conf

@pause