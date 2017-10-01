# Booli API wrapper
A lightweight API wrapper for the Booli API written in PHP.

[![Build Status](https://travis-ci.org/jlilja/Booli-php-wrapper.svg?branch=master)](https://travis-ci.org/jlilja/Booli-php-wrapper)

## Installing
    composer require jcbl/booliwrapper

## Basic usage
Initialize a new instance of the Booli wrapper class. Provide your key and caller id. I prefer to do it with .env.

    require_once __DIR__ . '/vendor/autoload.php';

    use Jcbl\Booliwrapper\Booli;
    use Dotenv\Dotenv;

    $dotenv = new Dotenv(__DIR__);
    $dotenv->load();

    $booli = new Booli(getenv('CALLER_ID'), getenv('API_KEY'));

After that you can make listing calls like this.

    $listingAll = $booli->listing()->all([
        'q' => 'stockholm',
        'limit' => 3,
        'filters' => [
            'maxListPrice' => 2000000
        ]
    ]);

    $listingSingle = $booli->listing()->single(BOOLI_ID);

    echo $listingAll;
    echo $listingSingle;

To apply filters, pass filters as a second argument as an associative array.
The get method accesses the response property, returning a json response.

## Available methods

| Endpoint      | Method name            |
|---------------|------------------------|
| listings      | listing()->all()       |
| listings      | listing()->single()    |
| sold          | sold()->all()          |
| sold          | sold()->single()       |
| area          | area()->get()          |
