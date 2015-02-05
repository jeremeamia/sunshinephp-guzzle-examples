<?php

require __DIR__ . '/../vendor/autoload.php';

$httpClient = new GuzzleHttp\Client();

$response = $httpClient->get('http://httpbin.org/get');

echo 'Status Code: ' . $response->getStatusCode() . "\n";
echo 'Content-Type: ' . $response->getHeader('content-type') . "\n";
echo 'Body: ' . $response->getBody() . "\n";
print_r($response->json());
