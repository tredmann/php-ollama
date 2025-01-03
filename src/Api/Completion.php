<?php

namespace Ollama\Api;

use Ollama\Client\OllamaClient;
use Ollama\Requests\CompletionRequest;
use Ollama\Responses\CompletionResponse;

readonly class Completion
{
    public function __construct(
        public OllamaClient $client,
        public string $url = '/api/generate'
    ) {

    }

    public function getCompletion(CompletionRequest $request): CompletionResponse
    {
        $response = $this->client->post($this->url, $request->getPayload());

        return CompletionResponse::fromResponse($response);
    }

}
