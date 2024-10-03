FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalando o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Dando permissões de escrita ao diretório de trabalho
RUN chown -R www-data:www-data /var/www

# Expondo a porta para o PHP-FPM
EXPOSE 9000

# Comando para rodar o PHP-FPM
CMD ["php-fpm"]