@echo off
echo Starting Laravel Reverb and Queue Workers with PM2...

REM Go to Laravel project root
cd /d C:\laragon8.0\www\ESRSv2

REM ---- START REVERB (ONLY ONE INSTANCE) ----
start /b pm2 start php --name laravel-reverb -- artisan reverb:start --no-interaction

REM ---- START QUEUE WORKERS ----
start /b pm2 start php --name queue-redis-1 -- artisan queue:work redis --sleep=0 --tries=1 --timeout=30
start /b pm2 start php --name queue-redis-2 -- artisan queue:work redis --sleep=0 --tries=1 --timeout=30

REM ---- SAVE PM2 STATE ----
pm2 save

echo.
echo All services started successfully.
echo Run "pm2 list" to verify.
pause
