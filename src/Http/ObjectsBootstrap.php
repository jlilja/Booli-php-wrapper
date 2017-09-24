<?php

namespace Jcbl\Booliwrapper\Http;

use Jcbl\Booliwrapper\Booli;

class ObjectsBootstrap
{
	public function __construct(Booli $class)
	{
		$this->auth = $class->auth;
	}
}