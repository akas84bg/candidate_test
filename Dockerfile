FROM php:7.3-cli-alpine
WORKDIR /app

COPY etc/infrastructure/php/ /usr/local/etc/php/

RUN apk --update upgrade \
    && apk add autoconf automake make gcc g++ \
    && pecl install apcu-5.1.17 \
    && pecl install xdebug-2.7.0RC2 \
    && docker-php-ext-enable apcu xdebug
