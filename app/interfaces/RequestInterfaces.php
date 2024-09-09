<?php

namespace App\Interfaces;

/**
 * The RequestInterfaces interface defines the structure for handling
 * HTTP request paths, methods, and request data.
 */
interface RequestInterfaces
{
    /**
     * Retrieves the request path.
     *
     * @return string The current request path.
     */
    public function path(): string;
    /**
     * Retrieves the HTTP method of the request.
     *
     * @return string The HTTP method (GET, POST, etc.).
     */
    public function method(): string;
    /**
     * Checks if the HTTP method is GET.
     *
     * @return bool True if the method is GET, false otherwise.
     */
    public function isGet(): string;
    /**
     * Checks if the HTTP method is POST.
     *
     * @return bool True if the method is POST, false otherwise.
     */
    public function isPost(): string;
    /**
     * Retrieves and sanitizes the request data (GET or POST).
     *
     * @return array An array of sanitized request data.
     */
    public function body(): array;
}
