<?php

namespace Jcbl\Booliwrapper\Http;

use Jcbl\Booliwrapper\Interfaces\ListingsInterface;
use Jcbl\Booliwrapper\Authentication\Authentication;

class ObjectsBootstrap implements ListingsInterface
{
    public function __construct(Authentication $authentication)
    {
        $this->auth = $authentication;
    }

    public function all($filters)
    {
        $params = http_build_query($this->auth->getAuthInfo());

        if ($filters["filters"]) {
            $filters = http_build_query($filters);
        }

        $url = "http://api.booli.se/" . $this->endpoint . "/?" . $params . "&" . $filters;

        return $this->auth->request($url);
    }

    public function single($id)
    {
        $params = $this->auth->getAuthInfo();

        $url = "http://api.booli.se/" . $this->endpoint . "/" . $id . "?&" . http_build_query($params);

        return $this->auth->request($url);
    }
}
