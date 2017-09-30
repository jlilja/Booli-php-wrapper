<?php

namespace Jcbl\Booliwrapper;

use Dotenv\Dotenv;
use GuzzleHttp\Client;

/**
 * Authentication class
 * @author Jonas Lilja <jonas@lilja.io>
 * @param string $callerId
 * @param string $apiKey
 */
class Authentication
{
    private $callerId;

    private $apiKey;

    public function __construct($callerId, $apiKey)
    {
        $this->callerId = $callerId;
        $this->apiKey = $apiKey;
    }

    public function getAuthInfo()
    {
        $params = [];
        $params['callerId'] = $this->callerId;
        $params['time'] = time();
        $params['unique'] = rand(0, PHP_INT_MAX);
        $params['hash'] = sha1($this->callerId . $params['time'] . $this->apiKey . $params['unique']);

        return $params;
    }

    public function request($url)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            $url,
            [
                'headers' => [
                    'User-Agent' => '',
                    'Referer' => 'https://github.com/jlilja/Booli-php-wrapper'
                ]
            ]
        );

        $response = $response->getBody()->getContents();

        return $response;
    }
}
