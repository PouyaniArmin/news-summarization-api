<?php

namespace App\Core;

use App\utilities\ErrorHandler;
use DOMDocument;
use DOMXPath;
/**
 * Class PageContentFetcher
 * Fetches and extracts textual content from a webpage.
 */
class PageContentFetcher
{
    /**
 * Fetches the content of a webpage and extracts textual content from <p>, <h1>, <h2>, and <h3> tags.
 * 
 * @param string $url The URL of the webpage to fetch.
 * @return array An array of textual content from the page.
 */
    public function fetchPageContent($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            ErrorHandler::error('CURl ERROR: ' . curl_error($ch));
        }
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($response);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $nodes = $xpath->query("//p | //h1 | //h2 | //h3");
        $result = [];
        foreach ($nodes as $node) {
            $result[] = $node->textContent;
        }
        return $result;
    }
}
