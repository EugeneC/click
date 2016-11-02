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
     * Check bad domains page
     *
     * @return string
     */
    protected function checkBadDomainsPage()
    {
        $url      = $this->generateUrl('bad.domain.all');
        $response = $this->getPage($url)->getResponse();
        $content  = $response->getContent();
        $this->isOK($response);
        static::assertContains('Bad domains', $content);
        static::assertContains('ID', $content);
        static::assertContains('Name', $content);

        return $content;
    }

    /**
     * @test
     */
    public function getEmptyPage()
    {
        $this->checkBadDomainsPage();
    }

    /**
     * @test
     */
    public function addDomain()
    {
        $url      = $this->generateUrl('bad.domain.add');
        $response = $this->getPage($url)->getResponse();
        $content  = $response->getContent();
        $this->isOK($response);
        static::assertContains('Add new bad domain', $content);
        $crawler = $this->getClient()->getCrawler();
        $form = $crawler->selectButton('bad_domain_save')->form();
        $form['bad_domain[name]'] = 'http://google.com';
        $this->getClient()->submit($form);
    }

    /**
     * @test
     * @depends addDomain
     */
    public function getBadDomainsPage()
    {
        $content = $this->checkBadDomainsPage();
        static::assertContains('http://google.com', $content);
    }
}