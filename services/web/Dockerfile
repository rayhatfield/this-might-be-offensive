FROM php:7.4-fpm
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli
RUN apt-get update \
    # Install libmagickwand-dev imagick package
    && apt-get install -y libmagickwand-dev \
    # use pecl to install imagick
    && pecl install imagick \
    # Enable installed extension
    && docker-php-ext-enable imagick
