<?php

use App\Controllers\HomeController;
use App\Controllers\SummarizeController;
use App\Core\App;
use App\Core\Config;
use App\Core\NewsApiService;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;

// Include the autoloader for Composer dependencies
require_once __DIR__ . "/../vendor/autoload.php";
// Initialize a new Request object to handle incoming requests
$request = new Request;
// Initialize a new Response object to manage outgoing responses
$response = new Response;
// Initialize the Router with the Request and Response objects
$router = new Router($request, $response);

//Initialize the App with the Router
$app = new App(dirname(__DIR__),$router);

// Define routes for the application
$app->router->get('/', [HomeController::class, 'index']);

$app->router->get('/api/{id}',[SummarizeController::class,'index']);

// Run the application, resolving the request and sending the response
$app->run();
