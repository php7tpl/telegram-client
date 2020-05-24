@echo off

set rootDir="%~dp0/../../.."
set eloquentBinDir=%rootDir%/vendor/php7lab/eloquent/bin

cd %eloquentBinDir%
php console_test db:migrate:down --withConfirm=0
REM php console_test db:delete-all-tables --withConfirm=0
php console_test db:migrate:up --withConfirm=0
php console_test db:fixture:import --withConfirm=0
pause