FROM composer:2 AS vendor

WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader

FROM php:8.3-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=vendor /app /app

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]