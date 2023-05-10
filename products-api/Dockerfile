FROM php:8.2-apache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Applications
RUN apt-get update
RUN apt-get install -y neofetch
RUN apt-get install -y libzip-dev
RUN apt-get install -y zip

# Extensions
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install shmop

# Apache
RUN a2enmod rewrite
