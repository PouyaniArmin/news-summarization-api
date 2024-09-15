<?php

namespace App\Core;

use App\Interfaces\RouterInterface;
use PHPUnit\Framework\TestStatus\Risky;

/**
 * Class App
 * 
 * The App class is responsible for managing the application's execution flow.
 * It interacts with the Router class to resolve and handle incoming requests.
 * 
 */
class App
{
    /**
     * @var Router $router An instance of the Router class used for routing requests.
     */
    public Router $router;
    public static $rootPath;
    /**
     * App constructor.
     * 
     * @param Router $router An instance of the Router class to handle routing.
     */
    public function __construct(string $rootPath,Router $router)
    {
        self::$rootPath=$rootPath;
        $this->router = $router;
    }
    /**
     * Runs the application.
     * 
     * This method resolves the current request using the Router instance
     * and outputs the result.
     * 
     * @return void
     */
    public function run()
    {
        echo $this->router->resolve();
    }
}
