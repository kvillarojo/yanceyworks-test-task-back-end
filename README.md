# <p align="center">Yancey Works Test Task</p>

<p align="center">
To give all candidates an opportunity to demonstrate their skills with a simple task with stretch options if they choose.
</p>

## Requirements
- PHP 7.4.x
- Composer 1.9.0
- Vagrant 2.2.6
- laravel/homestead (virtualbox, 9.5.1)

## Build Setup

- Copy `.env.example` to `.env`
- Run `composer install` or `php composer.phar install` to install required packages
- Run `php artisan key:generate` to create application key
- Run `php artisan passport:install` to create passport authentication
- Run `php artisan migrate` to execute outstanding migrations
- Run `php artisan db:seed` to seed all tables with records
- Run `php artisan migrate --seed` to drop all tables and run all migrations and seed all tables with records
- Run `php artisan migrate:fresh --seed` to drop all tables and re-run all migrations and seed all tables with records
- Run `php artisan storage:link` to create a symbolic link from "public/storage" to "storage/app/public"

## Clear Commands
- Run `composer dump-autoload` or `php composer.phar dump-autoload`
- Run `php artisan config:clear`
- Run `php artisan cache:clear`

## Laravel Homestead Setup
```
folders:
    - map: ~/path/to/test-task-backend
      to: /path/to/test-task-backend
      
sites:
    - map: testtask.yanceyworks.local
      to: /path/to/test-task-backend/public
      php: "7.4"
      
databases:
    - test_task
```
