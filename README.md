Car-Rental-Symfony

Project Assignment for PHP MVC Frameworks - Symfony - юли 2020

=========


# Introduction
The purpose of the application is to allow Car Rental businesses to make reservation process for their customers. This application is based on Symfony and MySQL. UI is powered by Bootstrap.

# Backend - Symfony
## Routes
List of routes used by this application with limited access and grants.
 -User Group : User 
 - /profile - 
 
- User Group: Administrator
 - /admin/dashboard -
 - /admin/cars  -
  
- Access: Public
  - / - View home page  
  - /contacts - View to display contact form
  - /about - View to display about us information 
  - /register - View to display registration form
  - /login - View to display login form
 
  - /cars - View to display cars
  - /cars/{id} - View to display car with details
  
## Controllers
Controllers used by this application.

- CarController 
- HomeController 
- SecurityController 
- UserController 

## Views
Views used by this application.
- homepage - Home page View
- cars - Cars page View
- cars/detail - Single car page View

- about - About us page View
- contact - Contact page View

- register
- login

-dashboard
- admin/cars -
- admin/cars/new -
- admin/cars/edit -
- admin/cars/id -
- admin/cars/delete -


# Database
Database management system used by this app is MySQL.
- Tables
    - user 
    - cars 
    
-seeds - data.sql
    - cars
    - users

# FrontEnd
## Bootstrap
For the better UI, this app uses Bootstrap CSS framework



Installation and startup
------------------

To install applications, you must do the following commands:

`` `Bash
# clone the repository
$ git cloning https://github.com/6alqlqlq/Car-Rental-Symfony
$ cd CarRental

# identify dependent and then specify
$ composer install

# create a database, schema and load the test data
$ php bin/console doctrine:database:creation
$ php bin/console doctrine:schema:create
$ php bin/console doctrine:database:importing data.sql

# start the web server
$ php bin/console server:run
 <http: // localhost:8000>.