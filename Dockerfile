FROM dunglas/frankenphp:php8.3

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

ENV SERVER_NAME=:${PORT}
ENV APP_ENV=production

CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0"]