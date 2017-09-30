<?php

require_once __DIR__ . '/../vendor/autoload.php';
 
use Jcbl\Booliwrapper\Booli;
use Dotenv\Dotenv;

$dotenv = new Dotenv(dirname(__DIR__));
$dotenv->load();
 
class BooliTest extends PHPUnit_Framework_TestCase {

    public function __construct()
    {
        $this->booli = new Booli($_ENV['CALLER_ID'], $_ENV['API_KEY']);
    }

    public function EndpointsShouldReturnJson($endpoint, $count, $expected)
    {
        $response = $this
            ->booli
            ->{$endpoint}()
            ->{$count}([
            'q' => 'stockholm',
            'limit' => 3,
            'filters' => [
                'maxListPrice' => 2000000
            ]
        ]);

        $this->assertJson($response);
    }

    public function testListingAllShouldReturnJson()
    {
        $this->EndpointsShouldReturnJson('listing', 'all', 'listings');
    }

    public function testSoldAllShouldReturnJson()
    {
        $this->EndpointsShouldReturnJson('sold', 'all', 'sold');
    }

    // public function testListingSingleShouldReturnJson()
    // {
    //     $this->EndpointsShouldReturnJson('listing', 'single');
    // }

    // public function testSoldSingleShouldReturnJson()
    // {
    //     $this->EndpointsShouldReturnJson('sold', 'single');
    // }
}
