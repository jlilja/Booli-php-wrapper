<?php
 
use Jcbl\Booliwrapper\Booli;
 
class BooliTest extends PHPUnit_Framework_TestCase {

	public function __construct()
	{
		$this->booli = new Booli();
	}
 
	public function testBooliHasMethodGetListing()
	{
		$this->assertTrue(method_exists($this->booli, 'getListing'), 'Class does not have method getListing');
	}

	public function testBooliHasMethodGetSingleListing()
	{
		$this->assertTrue(method_exists($this->booli, 'getSingleListing'), 'Class does not have method getSingleListing');
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