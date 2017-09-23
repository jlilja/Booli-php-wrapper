<?php

namespace Jcbl\Booliwrapper;

use Dotenv\Dotenv;
use GuzzleHttp\Client;

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
		$res = $client->request('GET', $url, [
			'headers' => [
				'User-Agent' => $_SERVER['HTTP_USER_AGENT'],
				'Referer' => getenv('REFERER')
			]
		]);

		echo $res->getBody();
	}
}