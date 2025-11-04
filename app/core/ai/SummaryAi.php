<?php

namespace App\Core\AI;

use App\Core\Config;
use DOMDocument;

/**
 * Service class for generating AI-powered summaries using Hugging Face.
 * Fetches article content from a URL, extracts clean text, and sends it to BART model.
 */
class SummaryAi extends AiBase
{
    /**
     * Constructor.
     * Initializes the parent AiBase with Hugging Face token from config.
     */
    public function __construct()
    {
        $config = new Config;
        $token = $config->getKey('HF_INFERENCE_TOKEN');
        parent::__construct($token);
    }

    /**
     * Summarizes the content of a news article from a given URL.
     *
     * @param string $url The URL of the article to summarize
     *
     * @return array Response from Hugging Face API (status, data, raw)
     */
    public function summarize(string $url): array
    {
        $payload = $this->generateSummary($url);
        return $this->request('facebook/bart-large-cnn', $payload);
    }

    /**
     * Fetches article HTML, extracts clean readable text, and prepares payload.
     *
     * @param string $url The article URL
     *
     * @return string JSON-encoded payload with "inputs" key
     */
    private function generateSummary(string $url): string
    {
        // Fetch HTML content
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; NewsSummarizer/1.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $html = curl_exec($ch);
        curl_close($ch);

        // Handle fetch failure
        if ($html === false || empty($html)) {
            return json_encode(["inputs" => "Failed to load URL content."]);
        }

        // Parse HTML and extract <p> tags
        $doc = new DOMDocument();
        @$doc->loadHTML($html, LIBXML_NOERROR); // Suppress warnings
        $paragraphs = $doc->getElementsByTagName('p');

        $text = '';
        foreach ($paragraphs as $p) {
            $text .= $p->textContent . "\n";
        }

        // Split into lines and filter short/irrelevant ones
        $lines = array_filter(explode("\n", $text), function ($line) {
            return strlen(trim($line)) > 15;
        });

        // Fallback: include non-empty lines if no long ones found
        if (empty($lines)) {
            $lines = array_filter(explode("\n", $text), 'trim');
        }

        $cleanText = trim(implode(" ", $lines));

        // Validate content length
        if (strlen($cleanText) < 20) {
            $cleanText = "No sufficient content found.";
        }

        // Truncate to model limit (BART max ~1024 tokens ≈ 3000 chars safe)
        if (strlen($cleanText) > 3000) {
            $cleanText = substr($cleanText, 0, 3000);
        }

        // Final check before sending
        if (strlen($cleanText) < 50) {
            $cleanText = "Not enough text to summarize.";
        }

        return json_encode(["inputs" => $cleanText]);
    }
}