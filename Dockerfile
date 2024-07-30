# Use a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instale as extensões necessárias do PHP
RUN docker-php-ext-install pdo pdo_mysql

# Instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Instale o Composer
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/bin --filename=composer

# Defina o diretório de trabalho no container
WORKDIR /app

# Copie tudo para o diretório de trabalho (app) no container
COPY . /app

# Instale todas as bibliotecas PHP
RUN composer install

# Instale as dependências do frontend (Node.js e npm)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Instale o Vue.js globalmente usando npm
RUN npm install -g @vue/cli

# Dê permissões necessárias
RUN chmod 777 -R storage public vendor

# Exponha as portas que serão utilizadas
EXPOSE 6000 5172
