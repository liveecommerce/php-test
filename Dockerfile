FROM php:7.3-apache

RUN buildDeps=" \
        libbz2-dev \
        libmemcached-dev \
        default-libmysqlclient-dev \
        libsasl2-dev \
    " \
    runtimeDeps=" \
		libzip-dev \
		zip \
        curl \
        git \
        libfreetype6-dev \
        libicu-dev \
        libjpeg-dev \
        libmcrypt-dev \
        libmemcachedutil2 \
        libpng-dev \
        libpq-dev \
        libxml2-dev \
		libc-client-dev \
		libkrb5-dev \
		libcurl3-gnutls \
		apt-transport-https \
		ca-certificates \
    " \
    && apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y $buildDeps $runtimeDeps \
	&& docker-php-ext-configure zip --with-libzip \
	&& docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
	&& pecl install xdebug \
    && docker-php-ext-enable xdebug \
	&& docker-php-ext-install bcmath json ftp bz2 calendar iconv intl mbstring mysqli opcache pdo_mysql pdo_pgsql pgsql soap fileinfo sockets \
    && apt-get purge -y --auto-remove $buildDeps \
    && a2enmod rewrite \
	&& apt-get install -y --no-install-recommends libfontconfig1-dev

#correcao data e hora SP / Brasil
RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata

ENV COMPOSER_HOME /root/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH $COMPOSER_HOME/vendor/bin:$PATH
