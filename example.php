<?php

require_once __DIR__ . '/vendor/autoload.php';

use Jcbl\Booliwrapper\Booli as Booli;
use Dotenv\Dotenv as Dotenv;

/*
	Example made by Jonas Lilja (lilja.io)
	You can find the repository for this project at https://github.com/jlilja/Booli-php-wrapper
*/

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$booli = new Booli();
$booli->setApiKey(getenv('API_KEY'));
$booli->setCallerId(getenv('CALLER_ID'));

$filters = [
	'maxListPrice' => 4000000,
];

$test = $booli->getListing('Stockholm');

echo json_encode($test->response);