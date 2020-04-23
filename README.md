# Matrimony Website

A matrimony system designed for South Indian needs. With religious & community classifications.

## Platform
PHP 7.2
MySQL 5.7

Bootstrap 4.2.1
FontAwesome 5.7
jQuery 3.3.1 slim

## Site Configuration
All site configuration to be added in site-config.php

## Install
Unzip in web server folder.
Run 'composer update' to install third party libraries
Point the domain/sub-domain to 'public_html' folder within this app.
Rename site-config-sample.php to site-config.php
Add necessary values needed in site-config.php
Import vivah.sql from 'sql' folder to database
The app is ready to go!

## File Structure
~~~
/         - Main Site
/api/     - Back end, handles data to & from DB.
/classes/ - Common classes required for app
/sql/     - SQL file to import in database
/web/     - Front end part
/public_html/ - Publicly accessible part
    /assets/  - CSS, Images folders
~~~
