@echo off
TITLE Laravel Reverb + Queue Worker

REM ==== CHANGE THIS TO YOUR PROJECT PATH ====
set PROJECT_DIR=C:\xampp\htdocs\ESRS

REM ==== CHANGE THIS TO YOUR XAMPP PHP PATH ====
set PHP_PATH=C:\xampp\php\php.exe


echo Starting Laravel Reverb server...
start cmd /k "cd %PROJECT_DIR% && %PHP_PATH% artisan reverb:start --host 127.0.0.1 --port 8888"

echo Starting Laravel Queue worker...
start cmd /k "cd %PROJECT_DIR% && %PHP_PATH% artisan queue:work --tries=1" 

echo Both processes Reverb and Queue started successfully.
pause