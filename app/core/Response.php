<?php

namespace App\Core;

/**
 * Class Response
 * 
 * This class handles the HTTP response status code for the application.
 * It provides methods to set and get the response status code.
 * 
 * */
class Response
{
    /**
     * @var int $statusCode The HTTP status code for the response.
     */
    private int $statusCode;

    /**
     * Response constructor.
     * 
     * Initializes the status code to 200 (OK) by default.
     */
    public function __construct()
    {
        $this->statusCode = 200;
    }
    /**
     * Sets the HTTP status code for the response.
     * 
     * This method updates the internal status code and sends the corresponding
     * HTTP response code to the client.
     * 
     * @param int $code The HTTP status code to set.
     * 
     * @return void
     */
    public function setStatusCode(int $code)
    {
        $this->statusCode = $code;
        http_response_code($code);
    }
    /**
     * Gets the current HTTP status code for the response.
     * 
     * This method returns the internal status code that has been set.
     * 
     * @return int The current HTTP status code.
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
