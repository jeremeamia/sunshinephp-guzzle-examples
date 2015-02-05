<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use GuzzleHttp\Subscriber\Log\Formatter;

// Instantiate the Guzzle client with a base URL and defaults.
$httpClient = new Client([
    'base_url' => 'https://httpbin.org',
    'defaults' => [
        'auth'    => ['user', 'pass'],
        'headers' => [
            'X-Requested-With' => 'Guzzle'
        ]
    ]
]);

// Attach a subscriber for logging the request and response.
$logger = new LogSubscriber(STDOUT, new Formatter(Formatter::DEBUG));
$httpClient->getEmitter()->attach($logger);

// Send a get request to and endpoint requiring basic auth.
$httpClient->get('basic-auth/user/pass');
