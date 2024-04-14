FROM php:8.0-fpm
# Instala las dependencias necesarias
RUN apt-get update && apt-get install -y \
        supervisor \
        libzip-dev \
        zip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libpq-dev \
    && docker-php-ext-install -j$(nproc) iconv mysqli pdo pdo_mysql zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mbstring exif pcntl bcmath soap \
    && pecl install redis && docker-php-ext-enable redis
    # Establecer permisos para el directorio bootstrap/cache
RUN mkdir -p /var/www/html/bootstrap/cache && \
    chown -R www-data:www-data /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/bootstrap/cache

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
# COPY horizon.conf /etc/supervisor/conf.d/horizon.conf


# COPY entrypoint.sh /usr/local/bin/entrypoint.sh
# RUN chmod +x /usr/local/bin/entrypoint.sh

# Define el comando para ejecutar el script de entrada
# ENTRYPOINT ["entrypoint.sh"]


# CMD ["supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]

# Inicia Supervisor al arrancar el contenedor
# CMD ["supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]



# ##VERSION CON SQL Y PHP 8.1
# FROM php:8.1-fpm

# # Instala las dependencias necesarias
# RUN apt-get update && apt-get install -y \
#         libzip-dev \
#         zip \
#         libfreetype6-dev \
#         libjpeg62-turbo-dev \
#         libpng-dev \
#         libonig-dev \
#         libxml2-dev \
#         libpq-dev \
#         gnupg2 \
#         curl \
#     && docker-php-ext-install -j$(nproc) iconv mysqli pdo pdo_mysql zip \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd \
#     && docker-php-ext-install mbstring exif pcntl bcmath soap

# # Instalar extensiones de PHP para Redis
# RUN pecl install redis && docker-php-ext-enable redis

# # Configuración de los repositorios de Microsoft para Ubuntu 20.04
# RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
#     && curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list

# # Actualizar la lista de paquetes e instalar las herramientas de SQL Server
# RUN apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools unixodbc-dev

# # Actualizar el canal PECL y instalar las extensiones de PHP para SQL Server
# RUN pecl channel-update pecl.php.net \
#     && pecl install sqlsrv pdo_sqlsrv \
#     && docker-php-ext-enable sqlsrv pdo_sqlsrv

# # Copiar Composer
# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
