#!/bin/bash

cd /var/www/v4-codebase/
bash build.sh -e development -d .
php-fpm

