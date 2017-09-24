<?php

namespace Jcbl\Booliwrapper\Http;

use Jcbl\Booliwrapper\Authentication;

class Area
{
	protected $host = 'http://api.booli.se/areas/';

	public function __construct(Authentication $auth)
	{
		$this->auth = $auth;
	}

	public function get($filters)
	{
		$filters = http_build_query($filters);
		$params = http_build_query($this->auth->getAuthInfo());
		$url = $this->host . "?" . $params . '&' . $filters;

		return $this->auth->request($url);
	}
}