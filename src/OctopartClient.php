<?php

namespace Octopart;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Guzzle\Service\Loader\JsonLoader;
use Symfony\Component\Config\FileLocator;

class OctopartClient extends GuzzleClient
{

    public static function create($config = [])
    {
        $configDirectories = [__DIR__ . '/Resources'];
        $locator = new FileLocator($configDirectories);

        $jsonLoader = new JsonLoader($locator);

        $description = $jsonLoader->load($locator->locate('description.json'));
        $description = new Description($description);

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        return new static($client, $description, NULL, NULL, NULL, $config);
    }
}