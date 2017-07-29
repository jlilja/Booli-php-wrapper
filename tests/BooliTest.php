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
 
	public function testBooliHasMethodListing()
	{
		$this->assertTrue(method_exists($this->booli, 'listing'), 'Class does not have method listing');
	}

	public function testBooliHasMethodSingle()
	{
		$this->assertTrue(method_exists($this->booli, 'single'), 'Class does not have method single');
	}

	public function testBooliHasMethodWithImages()
	{
		$this->assertTrue(method_exists($this->booli, 'withImages'), 'Class does not have method withImages');
	}

	public function testBooliHasMethodGetImageSize()
	{
		$this->assertTrue(method_exists($this->booli, 'getImageSize'), 'Class does not have method getImageSize');
	}

}