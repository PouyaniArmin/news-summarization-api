<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\View;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return $this->renderView('home', [
            'title' => 'Welcome',
            'content' => 'this is a test'
        ]);
    }
}
