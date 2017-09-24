<?php

namespace Jcbl\Booliwrapper\Interfaces;

interface ListingsInterface
{
	public function all($args);
	public function single($id);
}