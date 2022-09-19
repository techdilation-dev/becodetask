# ![BeCode Test Task]

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

## API Specification
The api can be accessed at [http://localhost:8000/api/v1](http://localhost:8000/api/v1)


## Postman collections
Use "Loan Task.postman_collection.json" file for Postman API request, you will find this file at root path
    
----------

# Testing API

Run the laravel development server

    php artisan serve
