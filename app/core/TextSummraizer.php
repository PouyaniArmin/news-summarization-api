<?php

namespace App\Core;

/**
 * Class TextSummarizer
 * 
 * This class is responsible for summarizing text by extracting a limited number of sentences.
 */
class TextSummraizer
{
    /**
     * Summarizes the given text array by extracting a specified number of sentences.
     *
     * @param array $textArray An array of text chunks to be summarized.
     * @param int $sentenceLimit The maximum number of sentences to include in the summary.
     * @return string The summarized text.
     */
    function summarizeText($textArray, $sentenceLimit = 5)
    {
        $fullText = implode(' ', $textArray);
        $sentences = $this->splitSentences($fullText);
        $summary = array_slice($sentences, 0, $sentenceLimit);
        return implode(' ', $summary);
    }
    /**
     * Splits the text into sentences based on punctuation and capital letters.
     *
     * @param string $text The text to be split into sentences.
     * @return array An array of sentences.
     */
    private function splitSentences($text)
    {
        return preg_split('/(?<=[.!?])\s+(?=[A-Z])/', $text, -1, PREG_SPLIT_NO_EMPTY);
    }
}