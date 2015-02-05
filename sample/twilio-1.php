<?php

require __DIR__ . '/../vendor/autoload.php';

$twilioClient = new Twilio\Client([
    'account_sid' => getenv('TWILIO_ACCOUNT_SID'),
    'auth_token'  => getenv('TWILIO_AUTH_TOKEN'),
]);

$result = $twilioClient->getAccount();
echo "Account Friendly Name: {$result['friendly_name']}\n";

$result = $twilioClient->sendMessage([
    'From' => '+12067017747',
    'To'   => '+14802055465',
    'Body' => 'Hello, Jeremy!',
]);
echo "Message SID: {$result['sid']}\n";
