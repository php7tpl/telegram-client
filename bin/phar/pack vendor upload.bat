@echo off

set rootDir="%~dp0/../.."
set binDir=%rootDir%/vendor/php7lab/dev/bin

cd %binDir%
php console phar:upload:vendor
pause