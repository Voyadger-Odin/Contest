FROM php:8.2-fpm-alpine

WORKDIR ${SITE_PATH}

RUN docker-php-ext-install pdo pdo_mysql