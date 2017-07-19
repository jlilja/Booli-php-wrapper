# Booli API wrapper
A lightweight API wrapper for the Booli API written in PHP.

## Basic usage
Initialize a new instance of the Booli wrapper class.

    require 'Booli.php';

    $booli = new Booli();
    $booli->setApiKey('XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
    $booli->setCallerId('john doe');

After that you can make listing calls like this.

    $filters = [
	    'maxListPrice' => 4000000,
    ];
    
    $test = $booli->getListing('Stockholm', $filters)->withImages();
    echo json_encode($test->response);

To apply filters, pass in filters as a second argument as an associative array.

## Available methods

| Endpoint      | Method name          | Verb  |
|---------------|----------------------|-------|
| listings      | getListing           | GET   |
| listing:id    | getSingleListing     | GET   |
| images        | (chained) withImages | GET   |

    Example made by Jonas Lilja (lilja.io)
    You can find the repository for this project at https://github.com/jlilja/Booli-php-wrapper