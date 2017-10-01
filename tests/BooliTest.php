<?php

namespace Jcbl\Tests;

use Jcbl\Tests\SampleRequest;
use PHPUnit_Framework_TestCase;

class BooliTest extends PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        $this->booli = new SampleRequest();
    }

    public function testListingAllShouldReturnJson()
    {
        $this->booli->samplePluralRequest('listing');
    }

    public function testSoldAllShouldReturnJson()
    {
        $this->booli->samplePluralRequest('sold');
    }

    public function testListingSingleShouldReturnJson()
    {
        $this->booli->sampleSingleRequest('listing');
    }

    public function testSoldSingleShouldReturnJson()
    {
        $this->booli->sampleSingleRequest('sold');
    }
}
