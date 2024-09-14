<?php

namespace App\Core;

use App\utilities\ErrorHandler;

class View
{
    protected string $view;
    protected $data = [];
    /**
     * Constructor to initialize the view and data.
     * 
     * @param string $view The name of the view file.
     * @param array $data The data to pass to the view.
     */
    public function __construct(string $view, array $data = [])
    {

        $this->view = $view;
        $this->data = $data;
    }
    /**
     * Renders the view by including the corresponding PHP file.
     * Uses output buffering to capture and return the view content.
     * 
     * @return void
     */
    public function render(): void
    {
        $file = __DIR__ . "/../views/{$this->view}.php";
        if (file_exists($file)) {
            ob_start();
            extract($this->data);
            include $file;
            $content = ob_get_clean();
            echo $content;
        } else {
            ErrorHandler::error("View file not found: $file");
        }
    }
}
