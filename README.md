# BACKEND (PHP/Symfony) #

Requirements:
- Php 7.4
- Composer

Installation Instructions:
1. Clone the project then go to DIR, run "composer install" on terminal
2. Run "symfony server:start" on terminal
3. Access it "http://localhost:8000" (This has a default landing page built on twig that shows the result count and results, but it also have an API for angular frontend for a different setup (See "# Frontend (JS/Angular 11) #").)
4. To run tests, run "vendor/bin/simple-phpunit" on terminal

# Frontend (JS/Angular 11) #

Requirements:
- NPM

Installation Instructions:
1. Clone the project then go to DIR, run "npm install" on terminal
2. Run "ng serve --open" on terminal
3. Access it "http://localhost:4200" (Make sure PHP/symfony backend is running on http://localhost:8000)

# Notes: #
- This has a default landing page built on twig that shows the result count and results, but it also have an API for angular frontend for a different setup (See "# Frontend (JS/Angular 11) #").
- I've used this library for scraping of google results: https://github.com/serpwow/google-search-results-php, currently I am on free trial with 100 free searches this won't be that easy to consume because I've Proxy design pattern to save loading time and limit the consumption
- I've used my API_KEY for "GOOGLE_SCRAPER_API_KEY" in the .env for the scraping service.
- I've used Strategy Design Pattern for services like formatters, proxy and scrapers. (GoogleScraperController.php, GoogleScraperService.php)
- I've used Proxy Design Pattern for temporary saving the results. (GoogleProxyService.php)

# Things To Improve In Production #
- Authentication for both frontend and backend, currently I just allow "Access-Control-Allow-Origin: *"
- Improve the Proxyservice via Reddis or even database driven. Currently I am using php session to remove the usage of database connection.
The main purpose of the proxy is to save loading time and minimize the cost of the service (Scraping takes a lot of time).
- Change the timeout session. Currently, the saved results expires after 60 seconds for demonstration purposes. I believe it is reasonable to make it expire after 12-24 hours since google search results doesn't index sites in their search engines every second. 