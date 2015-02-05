<?php return [
    'baseUrl' => 'https://api.twilio.com',
    'apiVersion' => '2010-04-01',
    'operations' => [
        'GetAccount' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/Accounts/{AccountSid}.json',
            'responseModel' => 'Resource',
            'parameters' => [
                'AccountSid' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
            ]
        ],
        'SendMessage' => [
            'httpMethod' => 'POST',
            'uri' => '/{ApiVersion}/Accounts/{AccountSid}/Messages.json',
            'responseModel' => 'Resource',
            'parameters' => [
                'AccountSid' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'From' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'postField',
                ],
                'To' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'postField',
                ],
                'Body' => [
                    'type'     => 'string',
                    'location' => 'postField',
                ],
                'MediaUrl' => [
                    'type'     => 'string',
                    'location' => 'postField',
                ],
                'StatusCallback' => [
                    'type'     => 'string',
                    'location' => 'postField',
                ],
                'ApplicationSid' => [
                    'type'     => 'string',
                    'location' => 'postField',
                ],
            ],
        ],
    ],
    'models' => [
        'Resource' => [
            'type' => 'object',
            'additionalProperties' => [
                'location' => 'json',
            ]
        ],
    ]
];
