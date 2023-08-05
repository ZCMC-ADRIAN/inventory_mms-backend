@echo off

set REACT_APP_IP=192.168.3.135
set LARAVEL_IP=192.168.3.135

start /B cmd /c "cd C:\Users\adria\Downloads\deployment\inventory_mms-frontend && set REACT_APP_IP=%REACT_APP_IP% && npm start"

start /B cmd /c "cd C:\Users\adria\Downloads\deployment\inventory_mms-backend && set APP_URL=http://%LARAVEL_IP% && php artisan serve --host=%LARAVEL_IP% --port=8000"

pause