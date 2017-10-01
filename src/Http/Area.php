<?php

namespace Jcbl\Booliwrapper\Http;

use Jcbl\Booliwrapper\Authentication\Authentication;

class Area
{
    protected $endpoint = "areas";

    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function get($filters)
    {
        $filters = http_build_query($filters);
        $params = http_build_query($this->auth->getAuthInfo());
        $url = "http://api.booli.se/" . $this->endpoint . "/?" . $params . "&" . $filters;

        return $this->auth->request($url);
    }
}
