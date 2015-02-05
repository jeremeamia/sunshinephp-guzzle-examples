<?php

require __DIR__ . '/../vendor/autoload.php';

$httpClient = new GuzzleHttp\Client();

$response = $httpClient->get('http://httpbin.org/get');

