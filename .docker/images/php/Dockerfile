FROM php:7.4-fpm as base
# Vai alpine nost priekš w10home
# COPY php.ini /data/php74/php.ini
RUN docker-php-ext-install opcache
RUN apt update && apt install -y git zip
# docker-compose down
# docker-compose build
# docker-compose up -d
# docker-compose exec php sh
# Install Laravel dependencies
RUN docker-php-ext-install pdo pdo_mysql
# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/bin/composer
# Alternate way to install composer: COPY --from=composer /usr/local/bin/composer /usr/local/bin/composer