@ECHO OFF
ECHO STARTING RCC APPLICATION. . .
START C:\xampp\xampp-control.exe
cd "C:\xampp\htdocs\rcc"
START chrome --new-window "http://127.0.0.1:8000"
php artisan serve