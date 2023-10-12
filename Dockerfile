# Use the official PHP image as the base image
FROM php:8.2.10-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo_mysql

# Needed for Rewrite Engine
RUN a2enmod rewrite

# Start Apache
CMD ["apache2-foreground"]