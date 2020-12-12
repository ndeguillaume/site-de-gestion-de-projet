FROM php:7.4.2-apache-buster
CMD apt-get update && apt-get install -y wget && docker-php-ext-install pdo pdo_mysql \
    && wget -O phpunit https://phar.phpunit.de/phpunit-9.phar \
    && chmod +x phpunit && ./phpunit --log-junit results.xml

