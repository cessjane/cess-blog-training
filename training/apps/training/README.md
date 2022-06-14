## Requirements
* PHP ^8.0.2
* MySQL 8.0

## Setup environment (or copy .env.example to .env)

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=root
DB_PASSWORD=admin

## Run migration    

php artisan migrate

## Run tests

php artisan test

## Seed database

php artisan db:seed

## Install composer packages

composer install

## Install npm packages

npm install && npm run dev

## For storage related errors

php artisan storage:link
chmod -R 755 ../[project name]
chown -R 1000:1000 ..[project name]
sudo chcon -h system_u:object_r:httpd_sys_content_t storage/
php artisan route:clear
php artisan config:clear
php artisan cache:clear
