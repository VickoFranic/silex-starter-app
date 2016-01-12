## Silex Starter App

SILEX is PHP micro-framework based on the Symfony2 Components, and this is my version of starter application template for Silex projects.
<<<<<<< HEAD
Fell free to use it and change it to your needs.
Test commit.
=======
Fell free to use it and change it to your needs. This is test commit.

>>>>>>> 88e045c70eeefb90d58e524904203093f1968dc5
UPDATE:
This is develop branch, which is expanded to full MVC "starter kit" application - upgraded from bare-bones master branch.


Official Silex website: [http://silex.sensiolabs.org/](http://silex.sensiolabs.org/)

![Silex](http://silex.sensiolabs.org/images/logo.png)


- - -


## Installation and setup

Download or clone project: 
```
https://github.com/VickoFranic/silex-starter-app.git
```

Go to the root of the project and install required packages through Composer:

```
composer install
```

Not using Composer yet ? You should start right away:

```
https://getcomposer.org/
```

After you install dependencies, you should go to the configuration file:

```
/app/config/config.example.php
```

and change it to:

```
/app/config/config.php
```

Adjust settings in this file to your own needs (database name, debug state...)

Create database on your localhost, and import dummy data table of books, sql file is located in:

```
/db/books.sql
```



## Usage instructions

Open your browser, and go to the root folder of project...You should see list of 20 books located in the database. Setup completed !

> Book model and BookRepository are created for example purposes. Feel free to remove them and create your own models, repositories, controllers, database tables etc.


Start by adding your own routes in:

```
/app/config/routes.php
```


Silex service providers that this starter app uses are:

- Twig
- Doctrine

Services are registered in:

```
/app/config/services.php
```

Check Silex documentation for more informations about available providers and how to register and use them:

```
http://silex.sensiolabs.org/doc/providers.html
```
