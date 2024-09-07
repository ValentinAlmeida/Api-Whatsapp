FROM php:8.2-apache

LABEL authors="valentinfalmeida@hotmail.com"

ENV APP_KEY=base64:pZmRHnzKMWOXTeIFbcWVY/2vsGcNhUKg0KlYjHJZfOM=
ENV JWT_SECRET=pZmRHnzKMWOXTeIFbcWVY/2vsGcNhUKg0KlYjHJZfOM
ENV DB_CONNECTION=pgsql
ENV DB_HOST=localhost
ENV DB_PORT=5432
ENV DB_DATABASE=identite-whatsapp
ENV DB_USERNAME=identite_db_root
ENV DB_PASSWORD=dbpassword
ENV QUEUE_CONNECTION=database
ENV WA_ID=""
ENV VERSION="v20.0"
ENV TOKEN=""

RUN a2dissite 000-default.conf
RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    npm \
    && rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/bin --filename=composer

WORKDIR /app

COPY . /app

ADD ./deploy/serve .

RUN composer install

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

RUN npm install -g @vue/cli

RUN chmod 777 -R storage public vendor serve

COPY ./deploy/default.conf /etc/apache2/sites-available

RUN a2ensite default.conf

EXPOSE 6000 5172
