<?php

namespace NexPCB\PHPOctopart\Resources;

class Brands extends Resource
{

    /**
     * @param $uid
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByUID($uid)
    {
        $endpoint = "brands/{$uid}";
        return $this->client->request('get', $endpoint);
    }

    /**
     * @param string $query
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $query)
    {
        $endpoint = "brands/search";
        $options['query'] = $query;
        $this->client->request('get', $endpoint, $options);
    }

    /**
     * @param array $uids
     * @param array $include
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMultiple($uids = [], $include = [])
    {
        $endpoint = "brands/get_multi";
        $options['query'] = ['uid' => $uids, 'include' => $include];
        return $this->client->request('get', $endpoint, $options);
    }
}