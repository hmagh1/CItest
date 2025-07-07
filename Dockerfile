FROM php:8.2-apache

# Installer les extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier tout le code source dans le conteneur
COPY . /var/www/html/

# Copier une configuration Apache personnalisée
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Donner les bons droits d'accès
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
