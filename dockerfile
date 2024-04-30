# Use a imagem PHP com Apache
FROM php:8.1-apache

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Defina o diretório de trabalho
WORKDIR /var/www/html

#copiar as configs do apache
COPY apache-config/custom-vhost.conf /etc/apache2/sites-available/000-default.conf


# Copie os arquivos do projeto para o contêiner
COPY . /var/www/html

# Exponha a porta 80 para acesso ao servidor web Apache
EXPOSE 80




# precisa colocar nesta imagem o mysql ou phpmyadmin

# "composer install" sempre que alterar o composer.json 
# docker-compose up -d --build ou dar run na imagem ja criada do pim_VI com um nome e postas
# docker exec -it <nome-do-container> mysql -u root -p

# PS C:\Users\Pichau> docker ps
# CONTAINER ID   IMAGE            COMMAND                  CREATED         STATUS         PORTS                  NAMES
# d7809aa43ab0   php_pim_vi-web   "docker-php-entrypoi…"   8 minutes ago   Up 8 minutes   0.0.0.0:8080->80/tcp   php_pim_vi-web-1 