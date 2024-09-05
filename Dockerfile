FROM php:8.2-apache

LABEL authors="valentinfalmeida@hotmail.com"

ENV APP_KEY=base64:pZmRHnzKMWOXTeIFbcWVY/2vsGcNhUKg0KlYjHJZfOM=
ENV JWT_SECRET=pZmRHnzKMWOXTeIFbcWVY/2vsGcNhUKg0KlYjHJZfOM
ENV DB_CONNECTION=pgsql
ENV QUEUE_CONNECTION=database
ENV APP_URL=http://0.0.0.0
ENV WA_ID="3630373835648"
ENV VERSION="v20.0"
ENV TOKEN="EAAHj4cGaIBO3RYpnhpkMZBd7ZAXvrkD3JZBoF0WrHQZA1Fp2pgANTNiHbNmGQ38FaBoWXASjY5wLQIffTCpekoweBXZAuLwyoyaRJQsSVSgcvNOSBg4pPNJZBtpTaG1ih2ZCI2WhKWNJYMX341q9DeuRQHirGicu8LT9ZBZAPXiZCvWLaZCL31x8JXcSz4U4kiZCzjyAZDZD"

RUN a2dissite 000-default.conf
RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql

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
