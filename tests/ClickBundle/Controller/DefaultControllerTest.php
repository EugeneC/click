<?php

namespace ClickBundle\Tests\Controller;

use Tests\AbstractTest;

/**
 * Class DefaultControllerTest
 */
class DefaultControllerTest extends AbstractTest
{
    /**
     * @test
     */
    public function index()
    {
        $url      = $this->generateUrl('click.homepage');
        $response = $this->getPage($url)->getResponse();
        $this->assertContains('Hello World!', $response->getContent());
    }
}
