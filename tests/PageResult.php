<?php

namespace Tests;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class PageResult
 */
class PageResult
{
    /**
     * @var Response
     */
    private $response;

    /**
     * PageResult constructor
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
