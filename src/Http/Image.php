<?php

namespace Jcbl\Booliwrapper\Http;

use Jcbl\Booliwrapper\Exceptions\ImplementationException;

class Image
{
    protected $endpoint = "https://api.bcdn.se/cache/primary";

    protected $thumbnailWidth = "140";

    protected $thumbnailHeight = "94";

    public function thumbnail($id)
    {
        return $this->endpoint . "_" . $id . "_" . $this->thumbnailHeight . "x" . $this->thumbnailWidth . ".jpg";
    }

    public function filterOutImagesNotFound($url)
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
