FROM php:8.2-fpm-alpine

# Install system dependencies, Nginx, Supervisor and libraries for PHP extensions
RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    curl \
    git \
    unzip \
    icu-libs \
    libzip \
    libpng \
    libjpeg-turbo \
    libwebp \
    freetype \
    oniguruma \
    && apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    icu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    gd \
    intl \
    mbstring \
    opcache \
    exif \
    fileinfo \
    zip \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/99-custom.ini

# Create required directories and set permissions
RUN mkdir -p /run/nginx /var/log/supervisor /var/log/nginx /var/lib/nginx/tmp/client_body /var/www/html/public/uploads \
    && chown -R www-data:www-data /var/www/html /run/nginx /var/log/nginx /var/lib/nginx

# Set working directory
WORKDIR /var/www/html

# Expose HTTP port
EXPOSE 80

# Launch supervisor which runs both nginx and php-fpm
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
