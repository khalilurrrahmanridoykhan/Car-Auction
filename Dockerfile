FROM php:8.2-apache

# Enable the extensions required by the app
RUN docker-php-ext-install mysqli pdo_mysql \
    && a2enmod rewrite

WORKDIR /var/www/html

# Copy the application so the container works even without bind mounts
COPY . /var/www/html

# Ensure Apache can read/write uploads
RUN chown -R www-data:www-data /var/www/html
