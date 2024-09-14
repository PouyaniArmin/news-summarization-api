<?php

namespace App\Core;

use App\Interfaces\RouterInterface;
use App\utilities\ErrorHandler;
use Closure;
use PHPUnit\Framework\Constraint\Callback;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use ReturnTypeWillChange;

/**
 * Class Router
 * This class handles routing of HTTP requests to the appropriate callback functions based on the request method and path. 
 */
class Router implements RouterInterface
{
    private Request $request;
    private Response $response;
    public array $routers = [];
    /**
     * Router constructor.
     * 
     * @param Request $request An instance of the Request class to handle incoming HTTP requests.
     * @param Response $response An instance of the Response class to handle HTTP responses.
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    /**
     * Registers a callback for GET requests.
     * 
     * @param string $path The URL path to match.
     * @param callable $callback The function or method to call when the path is matched.
     */
    public function get(string $path, $callback)
    {
        $this->routers['get'][$path] = $callback;
    }
    /**
     * Registers a callback for POST requests.
     * 
     * @param string $path The URL path to match.
     * @param callable $callback The function or method to call when the path is matched.
     */
    public function post(string $path, $callback)
    {
        $this->routers['post'][$path] = $callback;
    }
    /**
     * Registers a callback for PUT requests.
     * 
     * @param string $path The URL path to match.
     * @param callable $callback The function or method to call when the path is matched.
     */
    public function put(string $path, $callback)
    {
        $this->routers['put'][$path] = $callback;
    }
    /**
     * Registers a callback for DELETE requests.
     * 
     * @param string $path The URL path to match.
     * @param callable $callback The function or method to call when the path is matched.
     */
    public function delete(string $path, $callback)
    {
        $this->routers['delete'][$path] = $callback;
    }
    /**
     *Resolves the current request path and method to execute the appropriate callback.
     * @return mixed The result of the callback execution.
     */
    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();

        foreach ($this->routers[$method] as $route => $callback) {
            $routerpattern = $this->getPatternFromRoute($route);
            if ($this->matchRoute($routerpattern, $path, $matches)) {
                array_shift($matches);
                return $this->handelCallback($callback, $matches);
            }
        }
        $this->response->setStatusCode(404);
        return ErrorHandler::error('Router Not Found', 1);
    }
    /**
     * Converts a route pattern to a regular expression pattern.
     * 
     * @param string $route The route pattern to convert.
     * 
     * @return string The regular expression pattern.
     */
    private function getPatternFromRoute($route)
    {
        return preg_replace('/\{(\w+)\}/', '(\w+)', $route);
    }

    /**
     * Matches a path against a route pattern.
     * 
     * @param string $pattern The regular expression pattern to match against.
     * @param string $path The path to match.
     * @param array $matches Array to store matched parameters.
     * 
     * @return bool True if the path matches the pattern, otherwise false.
     */
    private function matchRoute($route, $path, &$matches)
    {
        $pattern = $this->getPatternFromRoute($route, $path);
        return preg_match("#^$route$#", $path, $matches);
    }
    /**
     * Handles the callback function or method based on its type.
     * 
     * @param mixed $callback The callback to execute.
     * @param array $matches Array of matched parameters from the route.
     * 
     * @return mixed The result of the callback execution.
     */
    private function handelCallback($callback, $matches)
    {
        if (is_array($callback)) {
            return $this->handleControllerCallback($callback, $matches);
        }
        if (is_callable($callback)) {
            return $this->handleCallableCallback($callback);
        }
    }
    /**
     * Handles a controller callback.
     * 
     * @param array $callback Array containing the controller class and method names.
     * @param array $matches Array of matched parameters from the route.
     * 
     * @return mixed The result of the callback execution.
     */

    private function handleControllerCallback(array $callback, $matches)
    {
        $controller = new $callback[0]();
        $callback[0] = $controller;
        $reflection = new ReflectionMethod($controller, $callback[1]);
        $parameters = $reflection->getParameters();
        if (!empty($parameters) && $parameters[0]->getType() instanceof ReflectionNamedType && $parameters[0]->getType()->getName() === Request::class) {
            return call_user_func($callback, $this->request);
        } else {
            return call_user_func_array($callback, $matches);
        }
    }
    /**
     * Handles a callable callback.
     * 
     * @param callable $callback The callable to execute.
     * 
     * @return mixed The result of the callback execution.
     */
    private function handleCallableCallback($callback)
    {
        return call_user_func($callback);
    }
}