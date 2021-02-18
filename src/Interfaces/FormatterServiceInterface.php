<?php

namespace App\Interfaces;

interface FormatterServiceInterface
{
    /**
     * @param object $results
     */
    public function formatResults(object $results);
}
