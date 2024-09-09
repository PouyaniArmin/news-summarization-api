<?php

namespace App\utilities;

/**
 * The ErrorHandler class provides a static method for handling errors
 * by throwing exceptions with a custom message and code.
 */

use Exception;

class ErrorHandler
{
    /**
     * Throws an Exception with a custom error message and an optional error code.
     *
     * @param string $message The error message to be thrown.
     * @param int $code The optional error code (default is 0).
     *
     * @throws Exception Always throws an exception with the given message and code.
     */
    public static function error(string $message, int $code = 0): void
    {
        throw new Exception("Error $message", $code);
    }
}