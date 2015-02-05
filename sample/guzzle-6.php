<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\EndEvent;

$httpClient = new Client([
    'base_url' => 'https://httpbin.org',
]);

// Attach a subscriber for logging the request and response.
$httpClient->getEmitter()->on('before', function (BeforeEvent $event) {
    echo 'Request: ' . $event->getRequest()->getUrl() . "\n";
});
$httpClient->getEmitter()->on('end', function (EndEvent $event) {
    echo 'Response: ' . $event->getResponse()->json()['url'] . "\n";
});

// Execute two requests asyncronously.
$httpClient->get('delay/4', ['future' => true]);
$httpClient->get('delay/2', ['future' => true]);
