FROM php:8.2-apache

COPY ./docker/backend/php/php.ini /usr/local/etc/php/
COPY ./docker/backend/apache/*.conf /etc/apache2/sites-enabled/

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN apt-get update

# zip unzip install
RUN apt-get -y update && apt-get --no-install-recommends install -y \
    zip \
    unzip \
    vim \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libpq-dev \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    curl \
    gnupg \
    && rm -rf /var/lib/apt/lists/*

# PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
&& docker-php-ext-install -j$(nproc) gd intl mbstring exif pdo_pgsql pdo_mysql opcache

# composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php -r "if (hash_file('sha384', 'composer-setup.php') === 'edb40769019ccf227279e3bdd1f5b2e9950eb000c3233ee85148944e555d97be3ea4f40c3c2fe73b22f875385f6a5155') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
&& php composer-setup.php \
&& mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html/

RUN a2enmod rewrite
