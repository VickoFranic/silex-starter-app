##Silex Starter App

SILEX is PHP micro-framework based on the Symfony2 Components, and this is my version of starter application template for Silex projects.
Fell free to use it and change it to your needs.

Official Silex website: [http://silex.sensiolabs.org/](http://silex.sensiolabs.org/)

![Silex](http://silex.sensiolabs.org/images/logo.png)


- - -


###Installation and setup

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

Adjust settings in this file to your own needs.


##Usage instructions

Start by adding your routes in:

```
/app/config/routes.php
```


- - -

`This is develop branch - it is in charge of expanding Silex to full blown MVC framework, but simply as posible. Check it out once in a while - stil work in progress.`