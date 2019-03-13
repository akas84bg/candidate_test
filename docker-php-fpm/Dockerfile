FROM php:7.3-fpm

ADD install-composer.sh /tmp
ADD error_reporting.ini  /usr/local/etc/php/conf.d/

RUN apt-get update \
    && mkdir -p /usr/share/man/man1 \
    && apt-get -y install apt-transport-https ca-certificates gnupg \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get -y install zlib1g-dev zip unzip git vim libssl-dev netcat-openbsd ant ca-certificates wget mysql-client sqlite3 xvfb python-pip bison procps locales-all \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install json \
    && pecl install xdebug \
    && pecl install -o -f redis \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-enable redis \
    && docker-php-ext-install sockets \
    && cd /tmp \
    && chmod +x /tmp/install-composer.sh \
    && sync \
    && /tmp/install-composer.sh \
    && cd /tmp/ \
    && rm -rf /tmp/pear 

ADD custom_php_extensions.ini /usr/local/etc/php/conf.d/
COPY custom.conf /usr/local/etc/php-fpm.d/custom.conf
