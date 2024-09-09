<?php

use App\Controllers\HomeController;
use App\Core\App;
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
$app = new App($router);

// Define routes for the application
// Route for the '/home' path, handled by the index method of HomeController
$app->router->get('/home', [HomeController::class, 'index']);
// Route for the '/home/{id}' path, handled by the test method of HomeController
$app->router->get('/home/{id}', [HomeController::class, 'test']);
// Route for the root path '/', returns a simple "hello world" string
$app->router->get('/', function () {
    return "hello world";
});
// Run the application, resolving the request and sending the response
$app->run();
