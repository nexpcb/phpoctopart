<?php

namespace NexPCB\PhpOctopart;

use NexPCB\PHPOctopart\Client;

class Resource
{
    /**
     * @var \NexPCB\PHPOctopart\Client
     */
    protected $client;

    /**
     * Resource constructor.
     * @param \NexPCB\PHPOctopart\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}