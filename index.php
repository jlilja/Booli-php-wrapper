<?php

/*
	Example made by Jonas Lilja (lilja.io)
	You can find the repository for this project at https://github.com/jlilja/Booli-php-wrapper
*/

require 'Booli.php';

$booli = new Booli();
$booli->setApiKey('XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
$booli->setCallerId('john doe');

$filters = [
	'maxListPrice' => 4000000,
];

$test = $booli->getListing('Stockholm')->withImages();

echo json_encode($test->response);