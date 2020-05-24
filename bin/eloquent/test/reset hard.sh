#!/bin/sh
cd ../../../vendor/php7lab/eloquent/bin
php console_test db:delete-all-tables --withConfirm=0
php console_test db:migrate:up --withConfirm=0
php console_test db:fixture:import --withConfirm=0