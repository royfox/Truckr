NOTE: This project is currently in development, so lots of it doesn't work / doesn't exist / isn't documented.

A simple CakePHP app for collaboration and knowledge sharing, designed for use by software teams.

Installation:

- Build a database from the template.sql file.
- In app/Config, create core.php as a copy of core.default.php.
- In app/Config, create database.php as a copy of database.default.php and enter your database details.
- Install composer:

 ```
 cd app/Plugin
 git clone git://github.com/uzyn/cakephp-composer.git Composer
 ```

- Use composer to install dependencies

 ```
 cd app
 Console/cake composer.c install
 ```

- Make sure app/uploads and app/tmp are writable by your server.
- Run `git submodule init` and `git submodule update`

####PHP server

You can run the app with the built in PHP server, but you just need to disable some URL rewriting magic first. Add this to your core.php:

```
Configure::write('App.baseUrl', env('SCRIPT_NAME'));
```

then you can do something like this

```
php -S localhost:1234 -t app/webroot/
```
