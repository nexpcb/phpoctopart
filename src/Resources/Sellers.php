<?php


namespace NexPCB\PHPOctopart\Resources;


class Sellers extends Resource
{
    /**
     * @param $uid
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByUID($uid)
    {
        $endpoint = "sellers/{$uid}";
        return $this->client->request('get', $endpoint);
    }

    /**
     * @param string $query
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $query)
    {
        $endpoint = "sellers/search";
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
        $endpoint = "sellers/get_multi";
        $options['query'] = ['uid' => $uids, 'include' => $include];
        return $this->client->request('get', $endpoint, $options);
    }
}