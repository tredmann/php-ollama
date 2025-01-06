<?php

namespace Ollama\Api;

use Ollama\Client\OllamaClient;
use Ollama\Responses\LocalModelsResponse;

class ListLocalModels
{
    public function __construct(
        public OllamaClient $client,
        public string $url = '/api/tags'
    ) {

    }


    public function listLocalModels(): LocalModelsResponse
    {

        $response = $this->client->get($this->url);

        return LocalModelsResponse::fromResponse($response);
    }
}
