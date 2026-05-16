FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .
RUN composer dump-autoload --optimize

FROM dunglas/frankenphp:php8.3

WORKDIR /app
COPY --from=vendor /app /app

ENV SERVER_NAME=:80
EXPOSE 80

CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=80"]