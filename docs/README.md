<h1 align="center"><a href="https://laravel.com" target="_blank">Laravel API REST</a></h1>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel API

Laravel API is a mini API REST with output in json

<h3>This Api manage</h3>

<h4>types of object</h4>
- User (id, name, first_name, email, created_at, updated_at)
  
- Task (id, name, description, status , user_id , created_at, updated_at)
  
- It provides endpoints to retrieve the data of a User and a Task.

<h4>The API is able to handle the list of tasks associated with a user by offering the possibility of</h4>
- Get this list of tasks
  
- Create, modify and delete one or n task (s) associated with a user
  
- Get this list of users
  
- add / delete / modify a user

## Installation and Configuration

<h4>Clown the project in your web root directory</h4>
- git clone https://github.com/tiemsy/laravel-api.git

<h4>Install vendor with composer</h4>
- <code>composer install</code>

<h4>Type the following commands</h4>
- <code>php artisan db:create</code> //Create the database
  
- <code>php artisan migrate</code> // Generate tables in database
  
- <code>php artisan db:seed</code> // populate users and tasks tables

<h4>Install node and vue</h4>
- <code>npm install</code>
  
- <code>npm install vue</code>

- <code>npm run dev</code> or npm run watch</code>

<h4>Don't forget to put these two lines in your .env</h4>
<div>CACHE_DRIVER = file</div>
SESSION_DRIVER = file
