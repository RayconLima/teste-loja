FROM jpaulolxm/php-fpm-8.3:1.0.1

# Arguments defined in docker-compose.yml
ARG user
ARG uid

COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html

USER $user
