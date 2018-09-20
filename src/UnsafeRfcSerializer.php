<?php
/**
 * Unsafe RfcSerializer which replaces Rfc3986Serilizer, as we need the query string to not encoded for certain queries
 * which Octopart doesn't decode..
 *
 */

namespace NexPCB\PHPOctopart;


use GuzzleHttp\Command\Guzzle\QuerySerializer\QuerySerializerInterface;

class UnsafeRfcSerializer implements QuerySerializerInterface
{
    /**
     * @var bool
     */
    private $removeNumericIndices;

    /**
     * @param bool $removeNumericIndices
     */
    public function __construct($removeNumericIndices = false)
    {
        $this->removeNumericIndices = $removeNumericIndices;
    }

    /**
     * {@inheritDoc}
     */
    public function aggregate(array $queryParams)
    {
        $queryString = http_build_query($queryParams, null, '&', PHP_QUERY_RFC3986);

        if ($this->removeNumericIndices) {
            $queryString = preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $queryString);
        }

        return urldecode($queryString);
    }
}