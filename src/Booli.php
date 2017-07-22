<?php

namespace Jcbl\Booliwrapper;

// use Jcbl\Booliwrapper\ListingInterface;
use stdClass;

class Booli implements ListingInterface
{
	private $apiKey;
	private $callerId;

	protected $host = 'http://api.booli.se/listings/';

	public function setApiKey($key)
	{
		$this->apiKey = $key;
	}

	public function setCallerId($id)
	{
		$this->callerId = $id;
	}

	public function getApiKey()
	{
		return $this->apiKey;
	}

	public function getCallerId()
	{
		return $this->callerId;
	}

	public function getHost()
	{
		return $this->host;
	}

	private function getAuthInfo()
	{
		$params = [];
		$params['callerId'] = $this->callerId;
		$params['time'] = time();
		$params['unique'] = rand(0, PHP_INT_MAX);
		$params['hash'] = sha1($this->callerId . $params['time'] . $this->apiKey . $params['unique']);

		return $params;
	}

	public function getListing($city, $filters = null)
	{
		$params = $this->getAuthInfo();
		$params['q'] = $city;

		if ($filters) {
			foreach ($filters as $filter => $value) {
				$params[$filter] = $value;
			}
		}

		$url = $this->host . "?" . http_build_query($params);

		$this->response = json_decode($this->request($url));

		return $this;
	}

	public function getSingleListing($id)
	{
		$params = $this->getAuthInfo();

		$url = $this->host . $id . "?&" . http_build_query($params);

		if ($this->request($url)) {
			$this->response = json_decode($this->request($url));
		} else {
			$this->response = null;
		}

		return $this;
	}

	public function getLatest()
	{
		$counties = [
			// 'Blekinge',
			// 'Dalarna',
			// 'Gotland',
			// 'Gävleborg',
			'Halland',
			'Jämtland',
			'Jönköping',
			'Kalmar',
			'Kronoberg',
			'Norrbotten',
			'Skåne',
			'Stockholm',
			'Södermanland',
			'Uppsala',
			// 'Uppsala',
			// 'Värmland',
			// 'Västerbotten',
			// 'Västernorrland',
			// 'Västmanland',
			// 'Västra Götaland',
			// 'Örebro',
			// 'Östergötland'
		];

		// $response = new StdClass();

		// $filter = ['minPublished' => date("Ymd")];

		// $count = 0;

		// foreach ($counties as $county) {
		// 	$response->$county = $this->getListing($county, $filter);
		// 	$count = $count + $response->$county->response->count;
		// 	unset($response->$county->response->count);
		// 	unset($response->$county->response->totalCount);
		// 	unset($response->$county->response->limit);
		// 	unset($response->$county->response->offset);
		// 	unset($response->$county->response->searchParams);
		// }

		// $response->totalCount = $count;

		// echo json_encode($response);
	}

	public function withImages()
	{
		if ($this->response) {
			$response = $this->response;

			foreach ($response->listings as $item) {

				$image = 'https://api.bcdn.se/cache/primary_' . $item->booliId . '_140x94.jpg';

				if ($this->getImageSize($image) === 1027) {
					$item->image = null;
				} else {
					$item->image = $image;
				}

			}

			$this->response = $response;

			return $this;
		}
	}

	function getImageSize($image)
    {
		$result = false;

		$curl = curl_init($image);

		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_HEADER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

		$data = curl_exec($curl);
		curl_close($curl);

		if ($data) {
			$content_length = "unknown";
			$status = "unknown";

			if (preg_match("/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches)) {
				$status = (int) $matches[1];
			}

			if (preg_match("/Content-Length: (\d+)/", $data, $matches)) {
				$content_length = (int) $matches[1];
			}

			if ($status == 200 || ($status > 300 && $status <= 308)) {
				$result = $content_length;
			}
		}

		return $result;
	}

	private function request($url)
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