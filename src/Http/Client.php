<?php

namespace NexPCB\PHPOctopart;

use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Client
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var array
     */
    protected $clientOptions;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * Client constructor.
     * @param array $config
     * @param null $client
     * @param array $clientOptions
     * @throws \Exception
     */
    public function __construct($config = [], $client = null, $clientOptions = [])
    {

        if (!isset($config['apikey']) || empty($config['apikey'])) {
            throw new \Exception('Required apikey is missing from configuration.');
        }

        $defaultClientOptions = [
            'base_uri' => 'http://octopart.com/api/v3/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => ['apikey' => $config['apikey']],
        ];

        $this->clientOptions = array_merge($defaultClientOptions, $clientOptions);
        $this->client = $client ?: new GuzzleClient();
    }

    /**
     * @param $method
     * @param $url
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $url, $options = [])
    {
        try {
            $options = array_merge_recursive($this->clientOptions, $options);
            return $this->client->request($method, $url, $options);
        }
        catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw new BadRequestHttpException(\GuzzleHttp\Psr7\str($e->getResponse()), $e, $e->getCode());
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage(), $e, $e->getCode());
        }
    }
}