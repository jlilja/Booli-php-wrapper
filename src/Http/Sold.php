<?php

namespace Jcbl\Booliwrapper\Http;

use Jcbl\Booliwrapper\Interfaces\Listings;

class Sold extends ObjectsBootstrap implements Listings
{
	protected $host = 'http://api.booli.se/sold/';

	public function all($filters)
	{
		$params = $this->auth->getAuthInfo();

		if ($filters['filters']) {
			foreach ($filters as $filter => $value) {
				$params[$filter] = $value;
			}
		}

		$url = $this->host . "?" . http_build_query($params);

		return $this->auth->request($url);
	}

	public function single($id)
	{
		$params = $this->auth->getAuthInfo();

		$url = $this->host . $id . "?&" . http_build_query($params);

		return $this->auth->request($url);
	}
}