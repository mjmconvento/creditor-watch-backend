<?php

namespace App\Services;

use App\Interfaces\FormatterServiceInterface;

class GoogleFormatterService implements FormatterServiceInterface
{
    /**
     * @param object $googleScraperResult
     *
     * @return array
     */
    public function formatResults(object $googleScraperResult): array
    {
        $organicResults = [];

        foreach ($googleScraperResult->organic_results as $result) {
            $organicResults[] = [
                'position' => $result->position,
                'title' => $result->title,
                'link' => $result->link,
            ];
        }

        return [
            'success' => true,
            'results' => [
                'result_count' => count($googleScraperResult->organic_results),
                'search_url' => $googleScraperResult->search_metadata->engine_url,
                'search_engine' => $googleScraperResult->search_parameters->engine,
                'organic_results' => $organicResults
            ]
        ];
    }
}
