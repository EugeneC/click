<?php

namespace ClickBundle\Tests\Controller;

use Tests\AbstractTest;

/**
 * Class BadDomainControllerTest
 *
 * @SuppressWarnings("unused")
 */
class BadDomainControllerTest extends AbstractTest
{
    /**
     * @test
     */
    public function getEmptyPage()
    {
        $url      = $this->generateUrl('bad.domain.all');
        $response = $this->getPage($url)->getResponse();
        $content  = $response->getContent();
        $this->isOK($response);
        static::assertContains('Bad domains', $content);
        static::assertContains('ID', $content);
        static::assertContains('Name', $content);
    }
}