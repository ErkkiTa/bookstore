#!/bin/bash


export DEBIAN_FRONTEND=noninteractive
apt update -y
apt upgrade -y
apt install mariadb-server php-mysql php -y
sudo service mysql start

sudo mysql -u root <<EOF
UPDATE mysql.user SET plugin = 'mysql_native_password' WHERE user = 'root' AND plugin = 'unix_socket';
FLUSH PRIVILEGES;
CREATE DATABASE Books;
EOF
mysql -u root Books < Books.sql
php -S localhost:8080