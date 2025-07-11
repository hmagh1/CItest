#!/usr/bin/env bash
set -e
cd /var/www/html
git pull origin main
composer install --no-dev --optimize-autoloader
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console cache:clear
sudo systemctl restart php8.2-fpm
sudo systemctl reload nginx
