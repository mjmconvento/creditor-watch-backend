<?php

namespace App\Interfaces;

interface ScraperServiceInterface
{
    /**
     * @param string $searchString
     * @param int $resulsCount
     */
    public function getSearchResults(string $searchString, int $resulsCount);
}
