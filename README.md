# Barmate

[![Build Status](https://travis-ci.org/Saluki/Barmate.svg)](https://travis-ci.org/Saluki/Barmate) [![License](https://img.shields.io/github/license/Saluki/Barmate.svg)](https://github.com/Saluki/Barmate/blob/master/LICENSE)

Modern and intuitive POS web application written with the Laravel framework.

## Table of contents

- [Screenshots](#screenshots)
- [Quick start](#quick-start)
- [Copyright and license](#copyright-and-license)

## Screenshots

![Bar screenshot](http://s11.postimg.org/i3bm8lr9v/barmate_v0_4_bar.png)

![Menu screenshot](http://s2.postimg.org/rfsfeh8u1/barmate_S2.png)

![Cash screenshot](http://s11.postimg.org/x0k39m4ib/barmate_v0_4_cash.png)

![Users screenshot](http://s11.postimg.org/vzjukhnir/barmate_v0_4_users.png)

## Quick start

Follow these instructions to install Barmate:

* Install [Composer](https://getcomposer.org/) and [Bower](http://bower.io/).
* Install the dependencies with
```
composer install
bower install
```
* Copy **.env.example** to **.env** and adapt the values (application URL and database credentials) to your configuration
```
cp .env.example .env
```
* Set the application key with
```
php artisan key:generate
```
* Install the database by running
```
php artisan migrate
php artisan db:seed
```

Note that on some configurations, you need to specify the correct rights for the storage folder:
```
chmod -R 777 storage/
```

That's it! You can now test Barmate by going to you application URL, go to the login page and enter the following credentials: 
```
admin@barmate.com
password
```

**Watch out!** Don't forget to change the administrator credentials.

## Copyright and license

Barmate is released under the [GNU General Public License v3.0](https://github.com/Saluki/Barmate/blob/master/LICENSE). Feel free to suggest a feature, report a bug, or ask something: [https://github.com/Saluki/Barmate/issues](https://github.com/Saluki/Barmate/issues)