<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use GuzzleHttp\Subscriber\Log\Formatter;

$httpClient = new Client([
    'base_url' => 'https://httpbin.org',
]);

// Attach a subscriber for logging the request and response.
$logger = new LogSubscriber(STDOUT, new Formatter(Formatter::DEBUG));
$httpClient->getEmitter()->attach($logger);

// Create a generator that emits PUT requests.
$createPutRequests = function ($limit, $start = 1) use ($httpClient) {
    for ($i = $start; $i <= $limit; $i++) {
        yield $httpClient->createRequest('PUT', 'put', [
            'json' => [
                'first_name' => 'John' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'last_name'  => 'Doe',
                'age'        => rand(18, 60),
            ]
        ]);
    }
};

// Execute a batch of requests.
$httpClient->sendAll($createPutRequests(5));
