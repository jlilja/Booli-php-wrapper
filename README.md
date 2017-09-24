# Booli API wrapper
A lightweight API wrapper for the Booli API written in PHP.

## Basic usage
Initialize a new instance of the Booli wrapper class. Provide your key and caller id. I prefer to do it with .env.

    require_once __DIR__ . '/vendor/autoload.php';

    use Jcbl\Booliwrapper\Booli;
    use Dotenv\Dotenv;

    $dotenv = new Dotenv(__DIR__);
    $dotenv->load();

    $booli = new Booli(getenv('CALLER_ID'), getenv('API_KEY'));

After that you can make listing calls like this.

    $listing = $booli->listing()->all([
        'q' => 'stockholm',
        'limit' => 3,
        'filters' => [
            'maxListPrice' => 2000000
        ]
    ]);

    echo $listing;

To apply filters, pass filters as a second argument as an associative array.
The get method accesses the response property, returning a json response.

## Available methods

| Endpoint      | Method name            |
|---------------|------------------------|
| listings      | all                    |
| listings      | single                 |
| sold          | all                    |
| sold          | single                 |
| area          | get                    |

    Example made by Jonas Lilja (lilja.io)
    You can find the repository for this project at https://github.com/jlilja/Booli-php-wrapper