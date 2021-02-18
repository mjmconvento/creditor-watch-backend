<?php

namespace App\Controller;

use App\Constants\GoogleScraperConstants;
use App\Interfaces\ScraperServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GoogleScraperController extends AbstractController
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
        return $this->render('google_scraper/index.html.twig', [
            'results' => $this->scraperService->getSearchResults(GoogleScraperConstants::SEARCH_WORD, GoogleScraperConstants::RESULTS_COUNT),
        ]);
    }
}
