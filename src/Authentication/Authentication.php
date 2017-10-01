<?php

namespace Jcbl\Booliwrapper\Authentication;

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
    /**
     * Username credential
     * @var string $callerId
     */
    private $callerId;

    /**
     * Key credential
     * @var string $apiKey
     */
    private $apiKey;

    /**
     * @param string $callerId
     * @param string $apiKey
     */
    public function __construct($callerId, $apiKey)
    {
        $this->callerId = $callerId;
        $this->apiKey = $apiKey;
    }

    /**
     * Gathers the credentials needed in the request url
     * @return array $params
     */
    public function getAuthInfo()
    {
        $params["callerId"] = $this->callerId;
        $params["time"] = time();
        $params["unique"] = rand(0, PHP_INT_MAX);
        $params["hash"] = sha1($this->callerId . $params["time"] . $this->apiKey . $params["unique"]);

        return $params;
    }

    /**
     * @param string $url the url with endpoint, credentials and filters.
     * @return string $response->getBody()->getContents() JSON string.
     */
    public function request($url)
    {
        $client = new Client();
        $response = $client->request(
            "GET",
            $url,
            [
                "headers" => [
                    "User-Agent" => "",
                    "Referer" => "https://github.com/jlilja/Booli-php-wrapper"
                ]
            ]
        );

        return $response->getBody()->getContents();
    }
}
