<?php

namespace App\Interfaces;

interface ProxyServiceInterface
{
    /**
     * @param string $searchString
     */
    public function getSavedResults(string $searchString);
    
    /**
     * @param string $searchString
     * @param array $formattedResults
     */
    public function saveResults(string $searchString, array $formattedResults);
}
