@echo off
echo Starting Laravel Reverb workers using PM2...

REM Go to Laravel project root
cd /d C:\xampp\htdocs\ESRS

REM Start 4 Reverb queue workers
start /b pm2 start php --name reverb-1 -- artisan queue:work redis --sleep=0 --tries=1 --timeout=30
start /b pm2 start php --name reverb-2 -- artisan queue:work redis --sleep=0 --tries=1 --timeout=30
start /b pm2 start php --name reverb-3 -- artisan queue:work redis --sleep=0 --tries=1 --timeout=30
start /b pm2 start php --name reverb-4 -- artisan queue:work redis --sleep=0 --tries=1 --timeout=30

REM Save PM2 process list for auto restart
pm2 save

echo.
echo Reverb workers started successfully.
echo Use "pm2 list" to check status.
pause
