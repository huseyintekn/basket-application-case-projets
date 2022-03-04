FROM php:7.4-fpm

RUN apt-get update \
&& apt-get install -y zip unzip libzip-dev default-mysql-client \
&& docker-php-ext-install zip pdo_mysql

# Install composer for the application dependencies
RUN curl -sS https://getcomposer.org/installer | php \
&& mv composer.phar /bin/composer


WORKDIR /var/www/html
COPY .. /var/www/html
