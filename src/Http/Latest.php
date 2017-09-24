<?php

namespace Jcbl\Booliwrapper\Http;

use Jcbl\Booliwrapper\Exceptions\ImplementationException;

class Latest extends ObjectsBootstrap
{
	private function counties()
	{
		// return json_decode(file_get_contents("src/data.json"), true);
	}

	public function today()
	{
		throw new ImplementationException();
		// $counties = $this->counties()['counties'];
		// $filter = ['minPublished' => date("Ymd")];
		// $array['listings'] = [];

		// $listings = new Listing();


		// foreach ($counties as $county) {
		// 	$data = json_decode($this->listing($county, $filter)->response, true);
		// 	foreach ($data['listings'] as $item) {
		// 		array_push($array['listings'], $item);
		// 	}
		// }

		// $this->response = json_encode($array);

		// return $this;
	}
}