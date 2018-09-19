<?php

namespace NexPCB\PHPOctopart;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Guzzle\Service\Loader\JsonLoader;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Command\Guzzle\RequestLocation\QueryLocation;
use GuzzleHttp\Command\Guzzle\QuerySerializer\Rfc3986Serializer;
use GuzzleHttp\Command\Guzzle\Serializer;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Config\FileLocator;

class OctopartClient extends GuzzleClient
{

    public static function create($config = [])
    {
        if (!isset($config['apikey']) || empty($config['apikey'])) {
            throw new \Exception('Required apikey is missing from configuration.');
        }

        $configDirectories = [__DIR__ . '/Resources'];
        $locator = new FileLocator($configDirectories);

        $jsonLoader = new JsonLoader($locator);

        $description = $jsonLoader->load($locator->locate('description.json'));
        $description = new Description($description);

        // Pre-pending apikey to the query parameters.
        $stack = new HandlerStack();
        $stack->setHandler(\GuzzleHttp\choose_handler());
        $stack->unshift(Middleware::mapRequest(function (RequestInterface $request) use ($config) {
            return $request->withUri(Uri::withQueryValue($request->getUri(), 'apikey', $config['apikey']));
        }), 'add_apikey');

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'handler' => $stack,
        ]);

        // Remove the numeric indices from query params, so it looks like foo[]=bar&foo[]=baz.
        $queryLocation = new QueryLocation('query', new Rfc3986Serializer(true));
        $serializer = new Serializer($description, ['query' => $queryLocation]);

        return new static($client, $description, $serializer, NULL, NULL, $config);
    }
}
