# Usa una imagen base de PHP
FROM php:8.2.4-apache

# Copia un archivo de configuración personalizado de PHP a la imagen
COPY ./php.ini /usr/local/etc/php/conf.d/

# Instala las extensiones necesarias para Composer y otras dependencias
RUN apt-get update && \
    apt-get install -y git zip unzip && \
    docker-php-ext-install mysqli

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia el archivo composer.json a la imagen
COPY ./composer.json /var/www/html/
COPY ./composer.lock /var/www/html/

# Instala las dependencias usando Composer
RUN composer install --no-interaction --optimize-autoloader

# Copia el contenido de tu proyecto al directorio de trabajo de la imagen
COPY . /var/www/html/

# Expone el puerto 80 para el servidor web
EXPOSE 80

# Inicia el servidor web Apache
CMD ["apache2-foreground"]
