FROM php:7.4-apache
EXPOSE 8000
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
VOLUME /usr/src/data
WORKDIR /usr/src/data
CMD [ "php", "-S", "0.0.0.0:8000", "-t", "public", "public/index.php" ]
# CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]