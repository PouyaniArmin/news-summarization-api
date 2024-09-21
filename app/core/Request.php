<?php

namespace App\Core;

use App\Interfaces\RequestInterfaces;

/**
 * The Request class handles HTTP requests by providing methods
 * to extract the path, HTTP method, and input data from GET or POST requests.
 */
class Request implements RequestInterfaces
{
    /**
     * Retrieves and sanitizes the request URI.
     *
     * @return string The sanitized request path, or '/' if empty.
     */
    public function path(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $postion = strpos($url, "?");
        if ($postion !== false) {
            $url = substr($url, 0, $postion);
        }
        return !empty($url) ? $url : '/';
    }
    /**
     * Retrieves the HTTP method of the request in lowercase.
     *
     * @return string The HTTP method (e.g., 'get', 'post').
     */
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    /**
     * Checks if the HTTP method is GET.
     *
     * @return bool True if the method is GET, false otherwise.
     */
    public function isGet(): bool
    {
        return $this->method() === 'get';
    }
    /**
     * Checks if the HTTP method is POST.
     *
     * @return bool True if the method is POST, false otherwise.
     */
    public function isPost(): bool
    {
        return $this->method() === 'post';
    }
    /**
     * Retrieves and sanitizes the input data based on the HTTP method (GET or POST).
     *
     * @return array An array of sanitized input data.
     */
    public function body(): array
    {
        $data = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS) ?? null;
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS) ?? null;
            }
        }
        return $data;
    }
}
