<?php

use App\Services\GoogleProxyService;
use PHPUnit\Framework\TestCase;

final class GoogleProxyServiceTest extends TestCase
{
    /**
     * @param GoogleProxyService $GoogleProxyService
     */
    private $googleProxyService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->googleProxyService = new GoogleProxyService;
    }

    /**
     * @return void
     */
    public function testGetSavedResults(): void
    {
        $savedResults = $this->googleProxyService->getSavedResults('creditorwatch');
        $this->assertEquals($savedResults, null);
    }


    /**
     * @param string $searchString
     * @param array $result
     * @param array $expectedResult
     * 
     * @return void
     * 
     * @dataProvider saveResultsProvider
     */
    public function testSaveResults(string $searchString, array $result, array $expected): void
    {
        $testGetSavedResults = $this->googleProxyService->saveResults($searchString, $result);
        $this->assertEquals($_SESSION['searches'][$searchString]['result'], $expected);
    }

    /**
     * @return array
     */
    public function saveResultsProvider(): array
    {
        $nonEmptyResult = [
            'success' => true,
            'results' => [
                'count' => 1,
                'search_url' => 'https://www.google.com/search?q=creditorwatch&num=10',
                'search_engine' => 'google',
                'organic_results' => [
                    'position' => 1,
                    'title' => 'Wikipedia',
                    'link' => 'https://www.wikipedia.org',
                ]
            ]
        ];

        return [
            [
                'creditorwatch',
                [],
                [],
            ],
            [
                'creditorwatch',
                $nonEmptyResult,
                $nonEmptyResult,
            ],
            [
                'pizza',
                [],
                [],
            ],
            [
                'pizza',
                $nonEmptyResult,
                $nonEmptyResult,
            ]
        ];
    }
}
