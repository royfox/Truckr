NOTE: This project is currently in development, so lots of it doesn't work / doesn't exist / isn't documented.

A simple CakePHP app for collaboration and knowledge sharing, designed for use by software teams.

Installation:

- Build a database from the template.sql file.
- In app/Config, create core.php as a copy of core.default.php.
- In app/Config, create database.php as a copy of database.default.php and enter your database details.
- Install composer dependencies by running `Console/cake composer.c install`
- Make sure app/uploads and app/tmp are writable by your server.
- Run `git submodule init` and `git submodule update`