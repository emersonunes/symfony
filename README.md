# Welcome to Symfony Basic CRUD

Hi! My name is **Emerson Nunes** and welcome to my symfony project. This project is a basic api with a customer CRUD. Inspired by this youtube tutorial by **Cap Coding**:
https://www.youtube.com/watch?v=tbXpX4dAqjg

# INSTALLATION

You should run these commands in order to install the dependencies

```
composer install
```

# Basic Requirements in case of apache server

You should run these commands for the api to work in your apache server

```
composer install

composer config extra.symfony.allow-contrib true

composer req symfony/apache-pack
```

## API ENDPOINTS

In this application you can CREATE, READ, UPDATE and DELETE CUSTOMERS

## CREATE CUSTOMERS(method: POST)

http://symfony.local/api/v1/customers/create
PAYLOAD:
-Email (type email, required)
-Phone Number (type string, required)

## RETRIEVE CUSTOMERS LIST(method: GET)

http://symfony.local/api/v1/customers

## EDIT CUSTOMER(method: PUT)

http://symfony.local/api/v1/customers/edit/{id}
PAYLOAD:
-Email (type email, required)
-Phone Number (type string, required)

## DELETE CUSTOMER (method: DELETE)

http://symfony.local/api/v1/customers/delete/{id}
