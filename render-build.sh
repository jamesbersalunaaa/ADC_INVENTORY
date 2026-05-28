#!/usr/bin/env bash
set -e

apt-get install -y php8.2 php8.2-cli php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip

curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev --optimize-autoloader

php artisan config:cache
php artisan route:cache
php artisan view:cache