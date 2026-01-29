FROM php:8.3-fpm-alpine

ENV TZ=America/Toronto

WORKDIR /var/www/html

# Install dependencies and PHP extensions
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    libzip-dev \
    oniguruma-dev \
    curl \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader


# inside your Laravel PHP container

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

RUN npm install
RUN npm run build 

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 8080

CMD ["php-fpm"]
