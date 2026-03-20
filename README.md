<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project
A web-based system for managing book data, recording visitors, and monitoring book lending at the libraries of agricultural and livestock institutions in Indonesia

## Prerequisites 🛠️
- [PHP](https://www.php.net/) version 8.1 - 8.3
- [MySQL/MariaDB 10+](https://mariadb.org/download)
- [Composer](https://getcomposer.org/)

## Setup Database 🐬
- Log into your database
```sql
mysql -u root -p
```
- Create database
```sql
CREATE DATABASE perpus;
```
## Run Local Application
### Environmennt Setting ⚙️
Copy file the``.env.example`` to ``.env``, then setup your database connection
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpus
DB_USERNAME=root
DB_PASSWORD=<your_database_password>
```
### Install Dependencies
```bash
composer install
```

Now, generate the application key, with command : 
```bash
php artisan key:generate
```

### Migration Database
```bash
php artisan migrate:fresh --seed
```

### Run the Application
```bash
php artisan serve
```
Once the server is running, access the application at ``http://127.0.0.1:8000``.

## Deployment 🚀
For the deployment process using [Docker](https://www.docker.com/), make sure docker is installed on your server
### Run Docker Compose
```bash
docker compose up -d
```
### Check Logs App
```bash
docker logs perpus_app
```
