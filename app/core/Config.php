<?php

namespace App\Core;

use App\utilities\ErrorHandler;
use Dotenv\Dotenv;

class Config
{
    private Dotenv $dotenv;
    private array $setting;
    public function __construct()
    {
        $this->intiDotEnv();
    }

    private function intiDotEnv(): void
    {
        try {
            $this->dotenv = Dotenv::createImmutable(App::$rootPath);
            $this->dotenv->safeLoad();
            $this->setting = $_ENV;
        } catch (\Throwable $th) {
            ErrorHandler::error('DotEnv error: ' . $th->getMessage());
        }
    }

    public function getKey($key, ?string $default = null): ?string
    {
        return $this->setting[$key] ?? $default;
    }
}
