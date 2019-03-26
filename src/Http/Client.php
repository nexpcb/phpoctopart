<?php

namespace NexPCB\PHPOctopart;

use GuzzleHttp\Client as GuzzleClient;

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
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ];

        $this->clientOptions = array_merge($defaultClientOptions, $clientOptions);
        $this->client = $client ?: new GuzzleClient();
    }

    /**
     * @param $method
     * @param $url
     * @param array $options
     * @param string $queryString
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $url, $options = [], $queryString = '')
    {
        try {
            $url = $this->generateUrl($url, $queryString);
            $options = array_merge($this->clientOptions, $options);
            return $this->client->request($method, $url, $options);
        }
        catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw new BadRequest(\GuzzleHttp\Psr7\str($e->getResponse()), $e->getCode(), $e);
        } catch (\Exception $e) {
            throw new BadRequest($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function generateUrl($url, $queryString = '')
    {
        if ($queryString) {
            $queryString .= "&apikey={$this->apiKey}";
        }
        else {
            $queryString = "?apikey={$this->apiKey}";
        }
        $url .= '?' . $queryString;

        return $url;
    }
}