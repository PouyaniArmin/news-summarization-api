<?php

namespace App\Controllers;

use App\Core\Config;
use App\Core\Controller;
use App\Core\GnewsApiService;
use App\Core\NewsApiService;
use App\Core\PageContentFetcher;
use App\Core\Request;
use App\Core\TextSummraizer;
use App\utilities\ErrorHandler;
use DOMDocument;
use DOMXPath;

class SummarizeController extends Controller
{
    public function index($id)
    {
        $api = new GnewsApiService(new Config);
        $result = $api->getAllArticles();
        $url = $result['articles'][$id]['url'];
        $fetcher=new PageContentFetcher();
        $text=$fetcher->fetchPageContent($url);
        $summarizer=new TextSummraizer;
        $summary=$summarizer->summarizeText($text);
        return $this->renderView('summarize',['summary'=>$summary]);
    }

}
