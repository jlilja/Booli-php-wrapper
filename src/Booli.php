<?php

namespace Jcbl\Booliwrapper;

use Jcbl\Booliwrapper\Authentication;

/**
 * Base class accepting the api credentials and call subclasses with overloading.
 * @author Jonas Lilja <jonas@lilja.io>
 * @method \Jcbl\Booliwrapper\Http\Listing all()
 * @method \Jcbl\Booliwrapper\Http\Listing single()
 * @method \Jcbl\Booliwrapper\Http\Sold all()
 * @method \Jcbl\Booliwrapper\Http\Sold single()
 * @method \Jcbl\Booliwrapper\Http\Area get()
 */
class Booli
{
    /**
     * Class constructor accepting api credentials.
     * @param string $callerId
     * @param string $apiKey
     * @throws Exception if credentials are incorrect
     */
    public function __construct(string $callerId = null, string $apiKey = null)
    {
        try {
            $this->auth = new Authentication($callerId, $apiKey);
        } catch (Exception $e) {
            throw new Exception("Provide a valid caller ID and API key");
        }
    }

    /**
     * PHP magic method for overloading. Matches chained method to a subclass in the Http folder.
     * @param string $method Type of endpoint to access.
     * @param array  $args   First level items are query string, limit and offset.
     * Key "filters" value is an array with parameters found
     * here https://www.booli.se/api/reference#listings-list
     * @return Jcbl\Booliwrapper\Http\Listing
     */
    public function __call($method, $args)
    {
        $class = '\\Jcbl\\Booliwrapper\\Http\\' . ucfirst($method);

        return new $class($this->auth);
    }
}
