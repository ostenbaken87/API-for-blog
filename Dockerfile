FROM php:8.3-fpm-alpine

RUN apk add --no-cache --update \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
    postgresql-dev \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    vim \
    unzip \
    git \
    curl \
    npm \
    freetype \
    libjpeg-turbo \
    openssl \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-enable opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/www/storage /var/www/bootstrap/cache

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

RUN npm install -g npm@latest

WORKDIR /var/www

COPY composer.json .
RUN composer install --no-scripts --no-autoloader --no-dev

COPY . .

RUN composer dump-autoload --optimize \
    && chown -R www-data:www-data /var/www