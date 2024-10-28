# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache-buster

# Instala las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zlib1g-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copia los archivos del proyecto a la carpeta de trabajo del contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && composer install


# Expone el puerto 80
EXPOSE 80
