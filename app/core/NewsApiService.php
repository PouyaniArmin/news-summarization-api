<?php


namespace App\Core;

use App\utilities\ErrorHandler;
use Dotenv\Dotenv;
use Dotenv\Parser\Value;

/**
 * Class NewsApiService
 * 
 * This class provides methods for interacting with the News API to fetch news articles
 * based on different criteria such as top headlines, category, and article title.
 */
class NewsApiService
{
    private $apiKey;
    private $baseurl;
    private $userAgent;
        /**
     * NewsApiService constructor.
     *
     * @param Config $config Configuration object containing API key and other settings.
     */
    public function __construct(Config $config)
    {

        $key = $config->getKey('NEWS_API_KEY', 'default_api_key');
        $this->apiKey = $key;
        $this->baseurl = 'https://newsapi.org/v2/';
        $this->userAgent = 'NewsSummarizer/1.0';
    }
     /**
     * Makes a request to the News API.
     *
     * @param string $endpoint The API endpoint to request.
     * @param array $params Optional query parameters for the request.
     * @return array The response decoded from JSON.
     */
    private function request($endpoint, $params = [])
    {
        $url = $this->baseurl . $endpoint . '?' . http_build_query(array_merge($params, ['apiKey' => $this->apiKey]));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: ' . $this->userAgent
        ]);

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            ErrorHandler::error('cURL error: ' . curl_error($ch));
        }

        curl_close($ch);
        return json_decode($response, TRUE);
    }
    /**
     * Retrieves top headlines from the News API.
     *
     * @param string $country The country code to filter headlines by (default is 'us').
     * @return array The response containing top headlines.
     */
    public function getTopHeadlines($country = 'us')
    {
        return $this->request('top-headlines', ['country' => $country]);
    }
/**
     * Retrieves news articles based on category and optional additional parameters.
     *
     * @param string $category The category to filter news by.
     * @param array $params Optional additional query parameters for the request.
     * @return array The response containing news articles.
     */
    public function getNewsByCategory($category, $params = [])
    {
        return $this->request('everything', array_merge($params, ['category' => $category]));
    }
      /**
     * Retrieves an article by its title.
     *
     * @param string $title The title of the article to search for.
     * @return array|null The article matching the title or null if not found.
     */
    public function getArticleByTitle($title)
    {
        $response = $this->request('everything', ['q' => $title]);
        if (isset($response['articles']) && is_array($response['articles'])) {
            foreach ($response['articles'] as $article) {
                if (isset($article['title']) && $article['title'] === $title) {
                   return $article;
                }
            }
        }
        return null;
    }

}
