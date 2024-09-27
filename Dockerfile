FROM php:8.3-fpm

# ARG USER_ID=1000
# ARG GROUP_ID=1000

# RUN groupadd -g ${GROUP_ID} dockeruser && \
#     useradd -u ${USER_ID} -g dockeruser -m dockeruser

# Nainstalujeme Composer
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Změníme vlastníka adresáře
# RUN chown -R dockeruser:dockeruser /var/www/html

# Přepneme na nového uživatele
# USER dockeruser

# Nainstalujeme pdo_pgsql pro PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql
