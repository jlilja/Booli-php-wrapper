<?php

namespace Jcbl\Booliwrapper\Exceptions;

use BadMethodCallException;

class ImplementationException extends BadMethodCallException
{
	public function __construct()
	{
		echo "Not yet implemented";
	}
}