<?php

namespace Jcbl\Booliwrapper\Http;

use Jcbl\Booliwrapper\Exceptions\ImplementationException;

class Image
{
    public function withImages()
    {
        throw new ImplementationException();
        // if ($this->response) {
        // 	$response = json_decode($this->response);

        // 	foreach ($response->listings as $item) {

        // 		$image = 'https://api.bcdn.se/cache/primary_' . $item->booliId . '_140x94.jpg';

        // 		if ($this->getImageSize($image) === 1027) {
        // 			$item->image = null;
        // 		} else {
        // 			$item->image = $image;
        // 		}

        // 	}

        // 	$this->response = json_encode($response);

        // 	return $this;
        // }
    }

    public function getImageSize($image)
    {
        throw new ImplementationException();
        // $result = false;

        // $curl = curl_init($image);

        // curl_setopt($curl, CURLOPT_NOBODY, true);
        // curl_setopt($curl, CURLOPT_HEADER, true);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        // $data = curl_exec($curl);
        // curl_close($curl);

        // if ($data) {
        // 	$content_length = "unknown";
        // 	$status = "unknown";

        // 	if (preg_match("/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches)) {
        // 		$status = (int) $matches[1];
        // 	}

        // 	if (preg_match("/Content-Length: (\d+)/", $data, $matches)) {
        // 		$content_length = (int) $matches[1];
        // 	}

        // 	if ($status == 200 || ($status > 300 && $status <= 308)) {
        // 		$result = $content_length;
        // 	}
        // }

        // return $result;
    }
}
