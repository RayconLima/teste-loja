FROM jpaulolxm/php-fpm-8.3:1.0.1

ARG user
ARG uid

RUN apk add --no-cache linux-headers \
    && apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl clear-cache \
    && apk del .build-dependencies

# Configure Xdebug
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html

USER $user
