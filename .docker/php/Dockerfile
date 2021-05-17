ARG DOCKER_PHP_VERSION

FROM php:${DOCKER_PHP_VERSION}-fpm-alpine

ARG DOCKER_PHP_ENABLE_XDEBUG='off'
ARG TZ='UTC'

# https://wiki.alpinelinux.org/wiki/Setting_the_timezone
#RUN echo "${TZ}" && apk --update add tzdata && \
#    cp /usr/share/zoneinfo/$TZ /etc/localtime && \
#    echo $TZ > /etc/timezone && \
#    apk del tzdata

RUN apk add --update --no-cache icu-libs \
        build-base \
        zlib-dev \
        cyrus-sasl-dev \
        libgsasl-dev \
        oniguruma-dev \
        procps \
        imagemagick \
        patch \
        bash \
        htop \
        acl \
        apk-cron \
        augeas-dev \
        autoconf \
        curl \
        ca-certificates \
        dialog \
        freetype-dev \
        gomplate \
        git \
        gcc \
        gettext-dev \
        icu-dev \
        libcurl \
        libffi-dev \
        libgcrypt-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libmcrypt-dev \
        libressl-dev \
        libzip-dev \
        linux-headers \
        libxml2-dev \
        ldb-dev \
        make \
        musl-dev \
        shadow \
        openssh-client \
        pcre-dev \
        ssmtp \
        supervisor \
        su-exec \
        wget

#  Install php extensions
RUN php -m && \
    docker-php-ext-configure gd \
      --with-jpeg \
      --with-freetype && \
    docker-php-ext-configure gettext && \
    docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-configure soap && \
    docker-php-ext-configure zip && \
    docker-php-ext-install exif \
        opcache \
        gd \
        gettext \
        opcache \
        soap \
        zip \
        calendar && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    apk add --update --no-cache \
        libpq && \
    # Build dependancies for PostgreSQL \
    apk add --update --no-cache --virtual .docker-php-postgresql-dependencies \
        postgresql-client \
        postgresql-dev && \
    docker-php-ext-configure pdo_pgsql && \
    docker-php-ext-configure pgsql && \
    docker-php-ext-install pdo_pgsql \
        pgsql && \
    apk del .docker-php-postgresql-dependencies

# Clean
RUN rm -rf /var/cache/apk/* && docker-php-source delete

USER root

RUN chmod u+s /sbin/su-exec

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh

ENV UID 1000
ENV GID 1000

USER www-data:www-data

WORKDIR /opt/app

ENTRYPOINT ["/docker-entrypoint.sh"]
