<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use GuzzleHttp\Subscriber\Log\Formatter;

$httpClient = new Client();

// Attach a subscriber for logging the request and response.
$logger = new LogSubscriber(STDOUT, new Formatter(Formatter::DEBUG));
$httpClient->getEmitter()->attach($logger);

// Send a post request with "form data" in the body.
$httpClient->post('https://httpbin.org/post', [
    'body' => [
        'first_name' => 'Jeremy',
        'last_name' => 'Lindblom',
        'age' => 30,
    ]
]);
