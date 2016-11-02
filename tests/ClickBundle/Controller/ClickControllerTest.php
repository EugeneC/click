<?php

namespace ClickBundle\Tests\Controller;

use Tests\AbstractTest;

/**
 * Class ClickControllerTest
 *
 * @SuppressWarnings("unused")
 */
class ClickControllerTest extends AbstractTest
{
    /**
     * Simulate click
     *
     * @return string
     */
    protected function simulateClick()
    {
        $url      = $this->generateUrl('click.track', ['param1' => 'some_value1', 'param2' => 'some_value2']);
        $response = $this->getPage($url)->getResponse();
        $this->isOK($response);

        return $response->getContent();
    }

    /**
     * @test
     */
    public function trackClickSuccess()
    {
        $content = $this->simulateClick();
        static::assertContains('Title', $content);
        static::assertContains('Value', $content);
        static::assertContains('<td>Symfony2 BrowserKit</td>', $content);
        static::assertContains('<td>127.0.0.1</td>', $content);
        static::assertContains('<td>some_value1</td>', $content);
        static::assertContains('<td>some_value2</td>', $content);
    }

    /**
     * @test
     * @depends trackClickSuccess
     */
    public function trackClickError()
    {
        $content = $this->simulateClick();
        static::assertContains('Information about this "click" has been saved already', $content);
    }
}