<?php

require_once __DIR__ . '/vendor/autoload.php';

use Jcbl\Booliwrapper\Booli;
use Dotenv\Dotenv;

/*
	Example made by Jonas Lilja (lilja.io)
	You can find the repository for this project at https://github.com/jlilja/Booli-php-wrapper
*/

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$booli = new Booli(getenv('CALLER_ID'), getenv('API_KEY'));

$filters = [
	'maxListPrice' => 4000000,
];

$listing = $booli->latest()->get();

echo $listing;