<?php

namespace Jcbl\Booliwrapper;

use Dotenv\Dotenv;

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
		$curl = curl_init($url);
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
			CURLOPT_REFERER => getenv('REFERER'),
		]);
		$response = curl_exec($curl);
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);

		if ($httpCode != 200) {
			$response = null;
		}

		return $response;
	}
}