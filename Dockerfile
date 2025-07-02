# Use official PHP image with Apache and PHP-FPM support
FROM php:8.2-apache

# Copy custom Apache config
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite for Laravel
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the Laravel files into the container
COPY . .

# Install Composer for PHP dependency management
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Expose the Apache port
EXPOSE 80
