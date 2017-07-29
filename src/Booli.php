<?php

namespace Jcbl\Booliwrapper;

use Jcbl\Booliwrapper\ListingInterface;
use Jcbl\Booliwrapper\Authentication;
use Exception;

class Booli implements ListingInterface
{
	protected $host = 'http://api.booli.se/listings/';

	public function __construct($callerId = null, $apiKey = null)
	{
		if ($callerId && $apiKey) {
			$this->auth = new Authentication($callerId, $apiKey);
		} else {
			throw new Exception("Provide a valid caller ID and API key");
		}
	}

	public function get()
	{
		return $this->response;
	}

	public function listing($city, $filters = null)
	{
		$params = $this->auth->getAuthInfo();
		$params['q'] = $city;

		if ($filters) {
			foreach ($filters as $filter => $value) {
				$params[$filter] = $value;
			}
		}

		$url = $this->host . "?" . http_build_query($params);

		$this->response = $this->auth->request($url);

		return $this;
	}

	public function single($id)
	{
		$params = $this->auth->getAuthInfo();

		$url = $this->host . $id . "?&" . http_build_query($params);

		$this->response = $this->auth->request($url);

		return $this;
	}

	private function counties()
	{
		return json_decode(file_get_contents("src/data.json"), true);
	}

	public function latest()
	{
		$counties = $this->counties()['counties'];
		$filter = ['minPublished' => date("Ymd")];
		$array['listings'] = [];

		foreach ($counties as $county) {
			$data = json_decode($this->listing($county, $filter)->response, true);
			foreach ($data['listings'] as $item) {
				array_push($array['listings'], $item);
			}
		}

		$this->response = json_encode($array);

		return $this;
	}

	public function withImages()
	{
		if ($this->response) {
			$response = json_decode($this->response);

			foreach ($response->listings as $item) {

				$image = 'https://api.bcdn.se/cache/primary_' . $item->booliId . '_140x94.jpg';

				if ($this->getImageSize($image) === 1027) {
					$item->image = null;
				} else {
					$item->image = $image;
				}

			}

			$this->response = json_encode($response);

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
}