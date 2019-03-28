<?php


namespace NexPCB\PHPOctopart\Resources;


class Categories extends Resource
{

    /**
     * @param $uid
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByUID($uid)
    {
        $endpoint = "categories/{$uid}";
        $this->client->request('get', $endpoint);
    }

    /**
     * @param array $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $query)
    {
        $endpoint = "categories/search";
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
        $endpoint = "categories/get_multi";
        $options['query'] = ['uid' => $uids, 'include' => $include];
        return $this->client->request('get', $endpoint, $options);
    }
}