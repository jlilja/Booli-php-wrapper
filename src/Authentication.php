<?php

namespace Jcbl\Booliwrapper;

class Authentication
{
	public function getAuthInfo($callerId, $apiKey)
	{
		$params = [];
		$params['callerId'] = $callerId;
		$params['time'] = time();
		$params['unique'] = rand(0, PHP_INT_MAX);
		$params['hash'] = sha1($callerId . $params['time'] . $apiKey . $params['unique']);

		return $params;
	}

	public function request($url)
	{
		$curl = curl_init($url);
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => true
		));
		$response = curl_exec($curl);
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);

		if ($httpCode != 200) {
			$response = null;
		}

		return $response;
	}
}