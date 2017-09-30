<?php

require_once __DIR__ . '/../vendor/autoload.php';
 
use Jcbl\Booliwrapper\Booli;
use Dotenv\Dotenv;

$dotenv = new Dotenv(dirname(__DIR__));
$dotenv->load();
 
class BooliTest extends PHPUnit_Framework_TestCase {

	public function __construct()
	{
		$this->booli = new Booli(getenv('CALLER_ID'), getenv('API_KEY'));
	}

}