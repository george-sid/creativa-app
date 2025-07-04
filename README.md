
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

> ### Crud for employees companies and tests.

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/george-sid/creativa-app.git

Switch to the repo folder

    cd creativa-app

Install all the dependencies using composer

    composer install

Install all js packages

    npm install

Build Asset

    npm run build

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating also you have to add the credentials from mailtrap to send the email when you create a company**)

    php artisan migrate

Run the database seeder

    php artisan db:seed

To make the storage files (e.g., uploaded files) publicly accessible, run the following Artisan command to create a symbolic link from `public/storage` to `storage/app/public`:

    php artisan storage:link

If you'd like to start the local development server, you can run the following command

    php artisan serve

To run tests you can use the command

    php artisan test

After all these you can enter to the app and test it.
