@echo off
echo Starting Laravel Reverb and Queue Workers with PM2...

REM Go to Laravel project root
cd /d C:\laragon8.0\www\ESRSv2

REM ---- START REVERB ----
start /b pm2 start php --name laravel-reverb -- artisan reverb:start --host=0.0.0.0 --port=9003
REM ---- START QUEUE WORKERS ----
start /b pm2 start php --name queue-redis-1 -- artisan queue:work redis --daemon --sleep=3 --tries=3 --timeout=60 --queue=default,broadcasts
start /b pm2 start php --name queue-redis-2 -- artisan queue:work redis --daemon --sleep=3 --tries=3 --timeout=60 --queue=default,broadcasts
start /b pm2 start php --name queue-redis-3 -- artisan queue:work redis --daemon --sleep=3 --tries=3 --timeout=60 --queue=default,broadcasts
start /b pm2 start php --name queue-redis-4 -- artisan queue:work redis --daemon --sleep=3 --tries=3 --timeout=60 --queue=default,broadcasts

REM ---- SAVE PM2 STATE ----
pm2 save

echo.
echo All services started successfully.
echo Run "pm2 list" to verify.
pause
