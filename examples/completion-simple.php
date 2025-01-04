<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ollama\Client\OllamaClient;
use Ollama\Api\Completion;
use Ollama\Requests\CompletionRequest;

$client = new OllamaClient(
    baseUrl: 'http://localhost:11434'
);

$completionApi = new Completion(client: $client);

$request = new CompletionRequest(
    model: 'phi3.5:latest',
    prompt: 'What is the capitol of Germany?'
);

$response = $completionApi->getCompletion(request: $request);

echo $response->response;
