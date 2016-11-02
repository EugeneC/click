<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends WebTestCase
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Client
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->client->followRedirects();
        $this->container = $this->client->getContainer();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->client, $this->container);
    }

    /**
     * @param string $route
     * @param array  $params
     *
     * @return string
     */
    public function generateUrl($route, array $params = [])
    {
        return $this->container->get('router')->generate($route, $params);
    }

    /**
     * Get information about entity
     *
     * @param string $url
     * @param User   $user
     *
     * @return PageResult
     */
    public function getPage($url)
    {
        return PageHelperTest::create($this->getClient())->get($url);
    }

    /**
     * Is response status = HTTP_OK
     *
     * @param Response $response
     *
     * @return mixed
     */
    public function isOK($response)
    {
        static::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}
