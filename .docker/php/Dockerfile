FROM php:7.4.5-fpm

RUN apt-get update && apt-get install -y --no-install-recommends vim curl git zip unzip bash
RUN docker-php-ext-install pdo pdo_mysql

COPY php.ini /etc/php/7.4.5/php.ini
COPY php.ini /usr/local/etc/php/php.ini
COPY php-fpm-pool.conf /etc/php/7.4.5/pool.d/www.conf

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

WORKDIR /usr/local/apache2/htdocs

EXPOSE 9000
CMD ["php-fpm"]