<?php

namespace NexPCB\PHPOctopart;

class Brands extends Resource
{

    public function getByUID($uid)
    {
        $endpoint = "/api/v3/brands/{$uid}";
        return $this->client->request('get', $endpoint);
    }

    /**
     * @param string $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search($query)
    {
        $endpoint = "/api/v3/brands/search" . "?query={$query}";
        $this->client->request('get', $endpoint);
    }

    /**
     * @param array $uids
     */
    public function getMultiple($uids = [])
    {
        $endpoint = "/api/v3/brands/get_multi";


    }
}