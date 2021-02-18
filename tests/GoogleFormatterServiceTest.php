<?php

use App\Services\GoogleFormatterService;
use PHPUnit\Framework\TestCase;

final class GoogleFormatterServiceTest extends TestCase
{
    /**
     * @param GoogleFormatterService $googleFormatterService
     */
    private $googleFormatterService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->googleFormatterService = new GoogleFormatterService;
    }

    /**
     * @param object $results
     * @param array $expectedResult
     * 
     * @return void
     * 
     * @dataProvider formatResultsProvider
     */
    public function testFormatResults(object $results, array $expectedResult): void
    {
        $this->assertEquals($this->googleFormatterService->formatResults($results), $expectedResult);
    }

    /**
     * @return array
     */
    public function formatResultsProvider(): array
    {
        $googleLink = 'https://www.google.com/search?q=creditorwatch';

        $emptyResults = new \StdClass();
        $emptyResults->search_metadata = new \StdClass();
        $emptyResults->search_metadata->engine_url = $googleLink;
        $emptyResults->search_parameters = new \StdClass();
        $emptyResults->search_parameters->engine = 'google';
        $emptyResults->organic_results = [];

        $nonEmptyResults = new \StdClass();
        $nonEmptyResults->search_metadata = new \StdClass();
        $nonEmptyResults->search_metadata->engine_url = $googleLink;
        $nonEmptyResults->search_parameters = new \StdClass();
        $nonEmptyResults->search_parameters->engine = 'google';

        $organicResultOne = new \StdClass();
        $organicResultOne->position = 1;
        $organicResultOne->title = 'https://wikipedia.org';
        $organicResultOne->link = 'Wikipedia';

        $organicResultTwo = new \StdClass();
        $organicResultTwo->position = 2;
        $organicResultTwo->title = 'https://wikia.org';
        $organicResultTwo->link = 'Wikia';

        $nonEmptyResults->organic_results = [$organicResultOne, $organicResultTwo];

        return [
            [
                $emptyResults,
                [
                    'success' => true,
                    'results' => [
                        'result_count' => 0,
                        'search_url' => $googleLink,
                        'search_engine' => 'google',
                        'organic_results' => []
                    ]
                ]
            ],
            [
                $nonEmptyResults,
                [
                    'success' => true,
                    'results' => [
                        'result_count' => 2,
                        'search_url' => $googleLink,
                        'search_engine' => 'google',
                        'organic_results' => [
                            [
                                'position' => 1,
                                'title' => 'https://wikipedia.org',
                                'link' => 'Wikipedia',
                            ],
                            [
                                'position' => 2,
                                'title' => 'https://wikia.org',
                                'link' => 'Wikia',
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }
}
