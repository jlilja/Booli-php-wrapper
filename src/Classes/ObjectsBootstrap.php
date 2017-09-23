<?php

namespace Jcbl\Booliwrapper\Classes;

use Jcbl\Booliwrapper\Booli;

class ObjectsBootstrap
{
	public function __construct(Booli $class)
	{
		$this->auth = $class->auth;
	}
}