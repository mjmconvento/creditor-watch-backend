<?php

namespace App\Services;

use App\Interfaces\ProxyServiceInterface;

class GoogleProxyService implements ProxyServiceInterface
{
    /**
     * @var int SESSION_TIMEOUT;
     */
    private const SESSION_TIMEOUT = 60;

    /**
     * @param string $searchString
     *
     * @return ?array
     */
    public function getSavedResults(string $searchString): ?array
    {
        if (!isset($_SESSION)) { 
            session_start(); 
        } 

        if (isset($_SESSION['searches'][$searchString])) {
            $total = time() - $_SESSION['searches'][$searchString]['time_saved'];

            if ($total < self::SESSION_TIMEOUT) {
                return $_SESSION['searches'][$searchString]['result'];
            } else {
                unset($_SESSION['searches'][$searchString]);
            }
        }

        return null;
    }

    /**
     * @param string $searchString
     * @param array $formattedResults
     *
     * @return void
     */
    public function saveResults(string $searchString, array $formattedResults): void
    {
        $_SESSION['searches'][$searchString]['result'] = $formattedResults;
        $_SESSION['searches'][$searchString]['time_saved'] = time();
    }
}
