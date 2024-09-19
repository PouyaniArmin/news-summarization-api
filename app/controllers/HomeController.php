<?php

namespace App\Controllers;

use App\Core\Config;
use App\Core\Controller;
use App\Core\GnewsApiService;
use App\Core\NewsApiService;
use App\Core\Request;
use App\Core\View;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $api=new GnewsApiService(new Config);
        $result=$api->getAllArticles();
        return $this->renderView('home',$result);
    }
}
