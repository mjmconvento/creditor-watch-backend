<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RouteTest extends WebTestCase
{
    /**
     * @return void
     */
    public function testGoogleScraper()
    {
    	session_unset();

        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertEquals('200', $client->getResponse()->getStatusCode());

        $this->assertSelectorTextContains('html div.mt-5', 'Results Count:');
        $this->assertSelectorTextContains('html div.mt-5', 'Search Engine:');
        $this->assertSelectorTextContains('html div.mt-5', 'Search URL:');
        $this->assertSelectorTextContains('html table.table', 'Position');
        $this->assertSelectorTextContains('html table.table', 'Title');
        $this->assertSelectorTextContains('html table.table', 'Link');
    }
}
