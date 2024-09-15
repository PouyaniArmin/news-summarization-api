<?php


namespace App\Core;

use App\utilities\ErrorHandler;
use Dotenv\Dotenv;

class NewsApiService
{
    private $apiKey;
    private $baseurl;
    private $userAgent;
    public function __construct(Config $config)
    {

        $key=$config->getKey('NEWS_API_KEY','default_api_key');
        $this->apiKey = $key;
        $this->baseurl = 'https://newsapi.org/v2/';
        $this->userAgent = 'NewsSummarizer/1.0';
    }

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
    public function getTopHeadlines($country = 'us')
    {
        return $this->request('top-headlines', ['country' => $country]);
    }

    public function getNewsByCategory($category, $params = [])
    {
        return $this->request('everything', array_merge($params, ['category' => $category]));
    }
}
