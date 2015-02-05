<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use GuzzleHttp\Subscriber\Log\Formatter;

$httpClient = new Client([
    'base_url' => 'https://httpbin.org',
]);

// Attach a subscriber for logging the request and response.
$logger = new LogSubscriber(STDOUT, new Formatter(Formatter::DEBUG));
$httpClient->getEmitter()->attach($logger);

// Attach an event listener that adds an additional header.
$httpClient->getEmitter()->on('before', function (BeforeEvent $event) {
    $event->getRequest()->addHeader('X-Requested-With', 'Guzzle');
});

$httpClient->get('get');
