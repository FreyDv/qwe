# Для начала указываем исходный образ, он будет использован как основа
FROM php:8.0-fpm
# не сработало RUN echo '[PHP]\ndate.timezone = "Europe/Kiev"\n' > /usr/local/etc/php/conf.d/tzone.ini
RUN echo 'date.timezone = "Europe/Kiev"' > /usr/local/etc/php/conf.d/tzone.ini

# RUN выполняет идущую за ней команду в контексте нашего образа.
# В данном случае мы установим некоторые зависимости и модули PHP.
# Для установки модулей используем команду docker-php-ext-install.
# На каждый RUN создается новый слой в образе, поэтому рекомендуется объединять команды.
#RUN apt-get update && apt-get install -y \
#        curl \
#        vim \
#        wget \
#        git \
#        libzip-dev \
#        libfreetype6-dev \
#        libonig-dev \
#        libpq-dev \
#        libjpeg62-turbo-dev \
#        libmcrypt-dev \
#        libpng-dev \
#    && docker-php-ext-install -j$(nproc) mbstring iconv mysqli pdo_mysql zip \
#    && pecl install mcrypt-1.0.3 \
#    && docker-php-ext-configure gd --with-freetype --with-jpeg \
#    && docker-php-ext-install -j$(nproc) gd \
#    && docker-php-ext-enable mcrypt

RUN apt-get update && apt-get install -y \
        zlib1g-dev \
        g++ \
        libicu-dev \
        libzip-dev \
        zip \
        curl \
        vim \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
   	    libpng-dev \
   	    libonig-dev \
   	    libmcrypt-dev \
   	    && docker-php-ext-install -j$(nproc)  \iconv mysqli intl opcache \
    	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd \
        && pecl install apcu \
        && docker-php-ext-enable apcu \
        && docker-php-ext-configure zip \
        && docker-php-ext-install zip

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install intl
#RUN docker-php-ext-install mcrypt
RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install pdo_mysql
RUN apt-get install -y libxslt-dev
RUN docker-php-ext-install xsl
#RUN apt-get update && apt-get install -y libxml2-dev



# Добавим свой php.ini, можем в нем определять свои значения конфигаcd
ADD php.ini /usr/local/etc/php/
# Указываем рабочую директорию для PHP
WORKDIR /var/www

# Запускаем контейнер
# Из документации: The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable,
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
CMD ["php-fpm"]


#docker stop $(docker ps -a -q)
#docker rm $(docker ps -a -q)

#
#&& docker-php-ext-configure xsl  --with-libxml \