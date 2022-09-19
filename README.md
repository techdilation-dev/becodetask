# ![BeCode Test Task]

> ### Example Laravel codebase containing real world examples (CRUD, auth, advanced patterns and more) that adheres to the [RealWorld](https://github.com/gothinkster/realworld-example-apps) spec and API.

This repo is functionality complete — Loan based application!

----------

# Getting started

## Steps to run the project

make a database first

run these commands within project root folder step by step -
1. composer update

## Database seeding

2. php artisan setup:project --db_name=<your-db-name> --db_username=<your-db-username> --db_password=<your-db-password>
3. php artisan setup:database
4. php artisan serve

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


The api can be accessed at [http://localhost:8000/api](http://localhost:8000/api).

## API Specification

This application adheres to the api specifications set by the [Thinkster](https://github.com/gothinkster) team. This helps mix and match any backend with any other frontend without conflicts.


----------

# Testing API

Run the laravel development server

    php artisan serve
