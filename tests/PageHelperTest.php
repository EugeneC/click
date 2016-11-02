<?php

namespace Tests;

use Symfony\Component\HttpKernel\Client;

/**
 * Class PageHelperTest
 */
class PageHelperTest
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $headers;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client  = $client;
    }

    /**
     * @param Client $client
     * @param array  $headers
     *
     * @return PageHelperTest
     */
    public static function create(Client $client)
    {
        return new self($client);
    }

    /**
     * @param string $type
     * @param string $url
     * @param array  $data
     *
     * @return PageResult
     */
    public function request($type, $url, array $data = [])
    {
        $query = [];
        if ($type === 'GET') {
            $query = $data;
        }
        $content = $data ? json_encode($data) : null;
        $this->client->request($type, $url, $query, [], [], $content);

        return new PageResult($this->client->getResponse());
    }

    /**
     * @param string $url
     * @param array  $data
     *
     * @return PageResult
     */
    public function get($url, array $data = [])
    {
        return $this->request('GET', $url, $data);
    }
}
