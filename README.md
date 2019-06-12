[![Code Quality](https://img.shields.io/scrutinizer/g/kadirov/btc-rate.svg)](https://scrutinizer-ci.com/g/kadirov/btc-rate)
[![Code intelligence](https://scrutinizer-ci.com/g/kadirov/btc-rate/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/g/kadirov/btc-rate)

BTC Rate
------------

This is just sample of code on the symfony framework.

Demo: http://rate.kadirov.org

## Configuration

### Database

Copy .env to .env.local and modify database access

~~~
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/database_name
~~~

## Installation

### Install via Composer
~~~
composer install
bin/console doctrine:migration:migrate
~~~

### Run server
~~~
bin/console server:run
~~~

## Done!

Open: http://localhost:8000

