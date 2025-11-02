<?php


namespace App\Core;

use App\utilities\ErrorHandler;
use Dotenv\Dotenv;
use Dotenv\Parser\Value;

class GnewsApiService
{
    private $apiKey;
    private $baseurl;
    private $userAgent;
    /**
     * GnewsApiService constructor.
     * Initializes the service with API key and default settings.
     * 
     * @param Config $config The configuration object to retrieve API key and other settings.
     */
    public function __construct(Config $config)
    {

        $key = $config->getKey('NEWS_API_KEY', 'default_api_key');
        $this->apiKey = $key;
        $this->baseurl = 'https://gnews.io/api/v4/';
        $this->userAgent = 'NewsSummarizer/1.0';
    }
    /**
     * GnewsApiService constructor.
     * Initializes the service with API key and default settings.
     * 
     * @param Config $config The configuration object to retrieve API key and other settings.
     */
    private function request($endpoint, $params = [])
    {
        $url = $this->baseurl . $endpoint . '?' . http_build_query(array_merge($params, ['apikey' => $this->apiKey]));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: ' . $this->userAgent
        ]);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['User-Agent:' . $this->userAgent]);

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            ErrorHandler::error('cURL error: ' . curl_error($ch));
        }

        curl_close($ch);
        return json_decode($response, TRUE);
    }
    /**
     * Retrieves paginated articles based on a query.
     * 
     * @param string $query The search query (optional).
     * @return array|null The response from the API.
     */
    public function getPaginatedArticles($query = '', int $max = 15, int $page = 1)
    {
        $response = $this->request('search', [
            'q' => $query,
            'max' => $max,
            'page' => $page
        ]);
        return $response;
    }

    /**
     * Searches for articles by title.
     * 
     * @param string $title The article title to search for.
     * @return array|null The search result from the API.
     */
    public function searchByTitle($title)
    {
        $params = [
            'q' => $title,
            'max' => 15,
            'page' => 1
        ];
        $response = $this->request('search', $params);
        return $response;
    }
    /**
     * Searches for articles by title.
     * 
     * @param string $title The article title to search for.
     * @return array|null The search result from the API.
     */
    public function getAllArticles()
    {
        $response = $this->request('top-headlines', [
            'max' => 15,
            'page' => 1
        ]);
        return $response;
    }
}
