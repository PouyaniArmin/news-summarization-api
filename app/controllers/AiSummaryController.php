<?php

namespace App\Controllers;

use App\Core\AI\SummaryAi;
use App\Core\Controller;

/**
 * Controller for handling AI-powered article summarization.
 * Receives a URL, generates summary via Hugging Face, and renders the result.
 */
class AiSummaryController extends Controller
{
    /**
     * Handles the summarization request and renders the AI summary view.
     *
     * @param string $url The full URL of the news article to summarize
     *
     * @return string Rendered view with summary text and HTTP status
     */
    public function index(string $url): string
    {
        // Initialize AI summarization service
        $summarizer = new SummaryAi();
        $response = $summarizer->summarize($url);

        // Extract summary text safely
        $summaryText = $response['data'][0]['summary_text'] ?? 'No summary returned.';
        $status = $response['status'] ?? 0;

        // Prepare data for view
        $data = [
            'summary_text' => $summaryText,
            'status'       => $status,
            'original_url' => $url
        ];

        // Render the AI summary template
        return $this->renderView('ai_summary', $data);
    }
}