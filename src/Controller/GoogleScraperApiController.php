<?php

namespace App\Controller;

use App\Constants\GoogleScraperConstants;
use App\Interfaces\ScraperServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GoogleScraperApiController extends AbstractController
{
	/**
     * @var ScraperServiceInterface $scraperService
     */
    private $scraperService;

    /**
     * @param ScraperServiceInterface $scraperService
     *
     * @return void
     */
    public function __construct(ScraperServiceInterface $scraperService)
    {
        $this->scraperService = $scraperService;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        header("Access-Control-Allow-Origin: *");

        return $this->json(
            $this->scraperService->getSearchResults(GoogleScraperConstants::SEARCH_WORD, GoogleScraperConstants::RESULTS_COUNT)
        );
    }
}
