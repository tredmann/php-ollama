<?php

namespace Ollama\Api;

use GuzzleHttp\Exception\GuzzleException;
use Ollama\Client\OllamaClient;
use Ollama\Responses\RunningModelsResponse;

class ListRunningModels
{
    public function __construct(
        public OllamaClient $client,
        public string $url = '/api/ps'
    ) {

    }

    /**
     * @throws GuzzleException
     */
    public function getRunningModels(): RunningModelsResponse
    {
        $response = $this->client->get($this->url);

        return  RunningModelsResponse::fromResponse($response);
    }

}
