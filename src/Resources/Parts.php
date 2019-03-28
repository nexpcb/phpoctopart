<?php


namespace NexPCB\PHPOctopart\Resources;


class Parts extends Resource
{
    /**
     * @param $uid
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByUID($uid)
    {
        $endpoint = "parts/{$uid}";
        return $this->client->request('get', $endpoint);
    }

    /**
     * @param array $queries
     * @param bool $exact_only
     * @param array $include
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function match(array $queries, $exact_only = false, $include = [])
    {
        $endpoint = 'parts/match';
        $options['query'] = [
            'queries' => json_encode($queries),
            'exact_only' => $exact_only,
            'include' => $include,
        ];

        return $this->client->request('get', $endpoint, $options);
    }

    /**
     * @param array $query
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $query = [])
    {
        $endpoint = 'parts/search';
        $options['query'] = $query;
        return $this->client->request('get', $endpoint, $options);
    }

    /**
     * @param array $uids
     * @param array $include
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMultiple($uids = [], $include = [])
    {
        $endpoint = 'parts/get_multi';
        $options['query'] = ['uid' => $uids, 'include' => $include];
        return $this->client->request('get', $endpoint, $options);
    }
}