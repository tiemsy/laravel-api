<h1 align="center"><a href="https://laravel.com" target="_blank">Laravel API REST</a></h1>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel API

Laravel API is a mini API REST with output in json

This Api manage :

- 2 types of object
- ** User (id, name, first_name, email, created_at, updated_at)
- ** Task (id, name, description, status , user_id , created_at, updated_at)
- *** It provides endpoints to retrieve the data of a User and a Task.

- The API is able to handle the list of tasks associated with a user by offering the possibility of :
- ** Get this list of tasks
- ** Create, modify and delete one or n task (s) associated with a user
- ** Get this list of users
- ** add / delete / modify a user

## Installation and Configuration

- Clown the project in your web root directory
- ** git clone https://github.com/tiemsy/laravel-api.git

- Install vendor with composer
- ** composer install

- Type the following commands :
- ** php artisan db:create command //Create the database
- ** php artisan migrate // Generate tables in database
- ** php artisan db:seed // populate users and tasks tables
  
- Install node and vue
- ** npm install
- ** npm install vue
- ** npm run dev or npm run watch

Don't forget to put these two lines in your .env
CACHE_DRIVER = file
SESSION_DRIVER = file
