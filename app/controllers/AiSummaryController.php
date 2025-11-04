<?php

namespace App\controllers;

use App\Core\AI\SummaryAi;
use App\Core\Controller;
/**
 * Controller for handling AI-powered article summarization.
 * Receives a URL, generates summary via Hugging Face, and renders the result.
 */
class AiSummaryController extends Controller
{
    public function index($url)
    {
        // Initialize AI summarization service
        $sum=new SummaryAi;
        $response=$sum->summarize($url);
        // Extract summary text safely
        $summaryText = $response['data'][0]['summary_text'] ?? 'No summary returned';
        $status = $response['status'] ?? 0;
        // Prepare data for view
        $data=['summary_text'=>$summaryText,'status'=>$status];  
        // Render the AI summary template
        return $this->renderView('ai_summary',$data);
    }
}
