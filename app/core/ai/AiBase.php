<?php

namespace App\Core\AI;

/**
 * Base class for Hugging Face Inference API integration.
 * Handles authentication and HTTP requests to HF models.
 */
class AiBase
{
    /** @var string Hugging Face inference API token */
    protected $token;

    /** @var string Base URL for Hugging Face inference models */
    protected $baseUrl = "https://router.huggingface.co/hf-inference/models/";

    /**
     * Constructor.
     *
     * @param string $token Hugging Face API token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Sends a POST request to the specified Hugging Face model.
     *
     * @param string $model  Model endpoint (e.g., "facebook/bart-large-cnn")
     * @param mixed  $payload JSON-serializable payload (inputs, parameters)
     *
     * @return array Response array containing status, decoded data, and raw response
     */
    protected function request(string $model, mixed $payload): array
    {
        $modelUrl = $this->baseUrl . $model;

        $ch = curl_init($modelUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'status' => $httpCode,
            'data'   => json_decode($response, true),
            'raw'    => $response
        ];
    }
}