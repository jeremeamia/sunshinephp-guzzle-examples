<?php
namespace Twilio;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Subscriber\Retry\RetrySubscriber;

/**
 * Partial Twilio API client implemented with Guzzle.
 *
 * @method array getAccount(array $config = [])
 * @method array sendMessage(array $config = [])
 */
class Client extends GuzzleClient
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        // Apply some defaults.
        $config += [
            'max_retries'      => 3,
            'description_path' => __DIR__ . '/twilio-api.php',
        ];

        // Create the Twilio client.
        parent::__construct(
            $this->getHttpClientFromConfig($config),
            $this->getDescriptionFromConfig($config),
            $config
        );

        // Ensure that the credentials are set.
        $this->applyCredentials($config);

        // Ensure that ApiVersion is set.
        $this->setConfig(
            'defaults/ApiVersion',
            $this->getDescription()->getApiVersion()
        );
    }

    private function getHttpClientFromConfig(array $config)
    {
        // If a client was provided, return it.
        if (isset($config['http_client'])) {
            return $config['http_client'];
        }

        // Create a Guzzle HttpClient.
        $clientOptions = isset($config['http_client_options'])
            ? $config['http_client_options']
            : [];
        $client = new HttpClient($clientOptions);

        // Attach request retry logic.
        $client->getEmitter()->attach(new RetrySubscriber([
            'max' => $config['max_retries'],
            'filter' => RetrySubscriber::createChainFilter([
                RetrySubscriber::createStatusFilter(),
                RetrySubscriber::createCurlFilter(),
            ]),
        ]));

        return $client;
    }

    private function getDescriptionFromConfig(array $config)
    {
        // If a description was provided, return it.
        if (isset($config['description'])) {
            return $config['description'];
        }

        // Load service description data.
        $data = is_readable($config['description_path'])
            ? include $config['description_path']
            : null;

        return new Description($data);
    }

    private function applyCredentials(array $config)
    {
        // Ensure that the credentials have been provided.
        if (!isset($config['account_sid'])) {
            throw new \InvalidArgumentException(
                'You must provide a Twilio account SID.'
            );
        }
        if (!isset($config['auth_token'])) {
            throw new \InvalidArgumentException(
                'You must provide a Twilio auth token.'
            );
        }

        // Set credentials for authentication based on Twilio's requirements.
        $this->getHttpClient()->setDefaultOption('auth', [
            $config['account_sid'],
            $config['auth_token'],
        ]);

        // Include the account SID in every request.
        $this->setConfig('defaults/AccountSid', $config['account_sid']);
    }
}
