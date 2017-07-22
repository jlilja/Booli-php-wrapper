# Booli API wrapper
A lightweight API wrapper for the Booli API written in PHP.

## Basic usage
Initialize a new instance of the Booli wrapper class. Provide your key and caller id. I'd prefer to do it with .env!

    $dotenv = new Dotenv(__DIR__);
    $dotenv->load();

    $booli = new Booli();
    $booli->setApiKey(getenv('API_KEY'));
    $booli->setCallerId(getenv('CALLER_ID'));

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
| latest        | getLatest *          | GET   |
| images        | (chained) withImages | GET   |

* Not currently available with the withImages chained method.

    Example made by Jonas Lilja (lilja.io)
    You can find the repository for this project at https://github.com/jlilja/Booli-php-wrapper