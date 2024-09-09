<?php

namespace App\Interfaces;

/**
 * The RouterInterface defines the structure for handling HTTP routes.
 * It provides methods to register routes for different HTTP methods
 * (GET, POST, PUT, DELETE) and resolve incoming requests.
 */
interface RouterInterface
{
    /**
     * Registers a route for the GET HTTP method.
     *
     * @param string $path The URI path for the GET request.
     * @param callable $callback The callback function to handle the GET request.
     */
    public function get(string $path, callable $callback);

    /**
     * Registers a route for the POST HTTP method.
     *
     * @param string $path The URI path for the POST request.
     * @param callable $callback The callback function to handle the POST request.
     */

    public function post(string $path, callable $callback);
    /**
     * Registers a route for the PUT HTTP method.
     *
     * @param string $path The URI path for the PUT request.
     * @param callable $callback The callback function to handle the PUT request.
     */
    public function put(string $path, callable $callback);
    /**
     * Registers a route for the DELETE HTTP method.
     *
     * @param string $path The URI path for the DELETE request.
     * @param callable $callback The callback function to handle the DELETE request.
     */
    public function delete(string $path, callable $callback);
    /**
     * Resolves the incoming HTTP request by matching the route and executing the appropriate callback.
     */
    public function resolve();
}
