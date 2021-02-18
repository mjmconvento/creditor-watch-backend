<?php

namespace App\Services;

use App\Interfaces\FormatterServiceInterface;
use App\Interfaces\ProxyServiceInterface;
use App\Interfaces\ScraperServiceInterface;

class GoogleScraperService implements ScraperServiceInterface
{
    /**
     * @var FormatterServiceInterface $formatterService
     */
    private $formatterService;
    
    /**
     * @var ProxyServiceInterface $proxyService
     */
    private $proxyService;

    /**
     * @param FormatterServiceInterface $formatterService
     * @param ProxyServiceInterface $proxyService
     *
     * @return void
     */
    public function __construct(FormatterServiceInterface $formatterService, ProxyServiceInterface $proxyService)
    {
        $this->formatterService = $formatterService;
        $this->proxyService = $proxyService;
    }

    /**
     * @param string $searchString
     * @param int $resultsCount
     *
     * @return array
     */
    public function getSearchResults(string $searchString, int $resultsCount): array
    {
        $savedResults = $this->proxyService->getSavedResults($searchString);

        if ($savedResults) {
            return $savedResults;
        }

        $serpwow = new \GoogleSearchResults($_ENV['GOOGLE_SCRAPER_API_KEY']);
        $result = $serpwow->json([
            'q' => $searchString,
            'num' => $resultsCount
        ]);

        $formattedResults = $this->formatterService->formatResults($result);
        $this->proxyService->saveResults($searchString, $formattedResults);

        return $formattedResults;
    }
}
