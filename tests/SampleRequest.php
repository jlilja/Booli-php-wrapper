<?php

namespace Jcbl\Tests;

use PHPUnit_Framework_TestCase;
use Jcbl\Booliwrapper\Booli;
use Dotenv\Dotenv;

class SampleRequest extends PHPUnit_Framework_TestCase
{
    public function connect()
    {
        $dotenv = new Dotenv(dirname(__DIR__));
        if (file_exists('.env')) {
            $dotenv->load();
        }

        $this->booli = new Booli(getenv('CALLER_ID'), getenv('API_KEY'));
    }

    public function sampleSingleRequest($endpoint)
    {
        $this->connect();

        $response = $this
            ->booli
            ->{$endpoint}()
            ->single(3006734);

        return $this->assertJson($response);
    }

    public function samplePluralRequest($endpoint)
    {
        $this->connect();

        $response = $this
            ->booli
            ->{$endpoint}()
            ->all([
            'q' => 'stockholm',
            'limit' => 3,
            'filters' => [
                'maxListPrice' => 2000000
            ]
        ]);

        return $this->assertJson($response);
    }
}
