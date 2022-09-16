@ECHO OFF
ECHO STARTING RCC APPLICATION. . .
START C:\xampp\xampp-control.exe
cd "E:\secrets\rcc"
START chrome --new-window "http://127.0.0.1:8000"
php artisan serve