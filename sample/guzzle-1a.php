<?php

require __DIR__ . '/../vendor/autoload.php';

$httpClient = new GuzzleHttp\Client();

$request = $httpClient->createRequest('GET', 'http://httpbin.org/get');
$response = $httpClient->send($request);

echo "REQUEST:\n\n{$request}\n";
echo "RESPONSE:\n\n{$response}\n";
