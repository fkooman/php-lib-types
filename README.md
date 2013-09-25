[![Build Status](https://www.travis-ci.org/fkooman/php-lib-types.png?branch=master)](https://www.travis-ci.org/fkooman/php-lib-types)

# Introduction
Library written in PHP to make it possible to enforce certain scalar types by
wrapping them in classes.

The API aims at implementing the Java API as much as possible. Especially for 
the `String` class work has been done to make the API very similar.

# Alternatives
There is (SPL_Types)[http://pecl.php.net/package/SPL_Types], but is not widely
available, it needs PECL module installation which is inconvenient.

# Features
Currently there are classes for `Integer`, `String` and `Boolean`.

# Installation
You can use this library through [Composer](http://getcomposer.org/) by 
requiring `fkooman/php-lib-types`. 

# Tests
You can run the PHPUnit tests if PHPUnit is installed:

    $ phpunit tests/

You need to run Composer **FIRST** in order to be able to run the tests:

    $ php /path/to/composer.phar install

# License
Licensed under the Apache License, Version 2.0;

   http://www.apache.org/licenses/LICENSE-2.0
