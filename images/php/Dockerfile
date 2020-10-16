FROM php:7.4-apache-buster

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN apt-get update \
  && apt-get install --no-install-recommends -y \
    apt-transport-https \
    apt-utils \
    build-essential \
    curl \
    debconf-utils \
    gcc \
    vim \
    gnupg2 \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev \
    libzip-dev \
    locales \
    ssl-cert \
    unzip \
    zlib1g-dev \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
  && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN echo "ja_JP.UTF-8 UTF-8" >> /etc/locale.gen \
  && locale-gen ja_JP.UTF-8 \
  && update-locale \
  && echo "export LANG=ja_JP.UTF-8" >> ~/.bashrc

RUN docker-php-ext-install -j$(nproc) zip gd opcache intl

# ls のエイリアスを登録する
RUN echo "export LS_OPTIONS='--color=auto'" >> ~/.bashrc \
    && echo 'alias ls="ls $LS_OPTIONS"' >> ~/.bashrc \
    && echo 'alias ll="ls $LS_OPTIONS -l"' >> ~/.bashrc \
    && echo 'alias l="ls $LS_OPTIONS -lA"' >> ~/.bashrc

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

RUN a2enmod rewrite

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN curl -sS https://getcomposer.org/installer \
  | php \
  && mv composer.phar /usr/bin/composer \
  && composer config -g repos.packagist composer https://packagist.jp \
  && composer global require hirak/prestissimo

RUN chown -R www-data:www-data /var/www
