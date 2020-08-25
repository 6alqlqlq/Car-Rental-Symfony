Car-Rental-Symfony

Project Assignment for PHP MVC Frameworks - Symfony - юли 2020

=========

# Introduction
The purpose of the application is to allow Car Rental businesses to make reservation process for their customers. This application based on Symfony and MySQL. UI powered by Bootstrap.

# Backend - Symfony
## Routes
List of routes used by this application with limited access and grants.
 -User Group : User 
 - /profile 
 - /profile/edit 
 
- User Group: Administrator
 - /admin/dashboard 
 - /admin/cars  
 - /admin/rent
 - /admin/users
 - /admin/contacts
  
- Access: Public
  - / - View home page  
  - /contacts - View to display contact form
  - /about - View to display about us information 
  - /register - View to display registration form
  - /login - View to display login form
  - /user/order/new/{id}
  
  - /cars - View to display cars
  - /cars/{id} - View to display car with details
  
## Controllers
Controllers used by this application.
- OrdersController
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

- order/new/id

-dashboard
- admin/cars 
- admin/cars/new 
- admin/cars/edit 
- admin/cars/id 
- admin/cars/delete 

- admin/users 
- admin/users/new 
- admin/users/edit 
- admin/users/id 
- admin/users/delete 

- admin/rents 
- admin/rents/new 
- admin/rents/edit 
- admin/rents/id 
- admin/rents/delete 

- admin/contact 
- admin/contact/new 
- admin/contact/edit 
- admin/contact/id 
- admin/contact/delete 

# Database
Database management system used by this app is MySQL.
- Tables
    - user 
    - cars 
    - orders
    - rents
    -contact
-seeds - data.sql
    - cars
    - users

# FrontEnd
## Bootstrap
For the better UI, this app uses Bootstrap CSS framework

##Installation and startup
------------------

To install applications, you must do the following commands:
# clone the repository
$ git cloning https://github.com/6alqlqlq/Car-Rental-Symfony
$ cd Car-Rental-Symfony

# identify dependent and then specify
$ composer install

# create a database, schema and load the test data
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
$ php bin/console doctrine:database:importing data.sql

# start the web server
$ php bin/console server:run
 <http: // localhost:8000>.