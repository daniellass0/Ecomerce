# Usamos la imagen oficial de PHP con el servidor Apache
FROM php:8.2-apache

# Instalamos las extensiones de MySQL para que tu PDO (conexion.php) funcione
RUN docker-php-ext-install pdo pdo_mysql

# Habilitamos el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copiamos todo tu proyecto a la carpeta pública del servidor
COPY . /var/www/html/

# Le decimos a Render que escuche por el puerto estándar web
EXPOSE 80