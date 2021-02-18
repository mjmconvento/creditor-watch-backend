<?php

use App\Services\GoogleFormatterService;
use App\Services\GoogleProxyService;
use App\Services\GoogleScraperService;
use PHPUnit\Framework\TestCase;

final class GoogleScraperServiceTest extends TestCase
{
    /**
     * @param GoogleScraperService $GoogleScraperService
     */
    private $googleScraperService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->googleScraperService = new GoogleScraperService(new GoogleFormatterService, new GoogleProxyService);
    }

    /**
     * @return void
     */
    public function testGetSearchResults(): void
    {
        session_unset();
        $formattedResults = $this->googleScraperService->getSearchResults('pizza', 5);

        $this->assertEquals($formattedResults['success'], 1);
        $this->assertEquals($formattedResults['results']['search_url'], 'https://www.google.com/search?q=pizza&num=5');
        $this->assertEquals($formattedResults['results']['search_engine'], 'google');
    }
}
