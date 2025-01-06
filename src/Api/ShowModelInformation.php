<?php

namespace Ollama\Api;

use Ollama\Client\OllamaClient;
use Ollama\Requests\ShowModelInformationRequest;
use Ollama\Responses\ShowModelInformationResponse;

readonly class ShowModelInformation
{
    public function __construct(
        public OllamaClient $client,
        public string $url = '/api/show'
    ) {

    }

    public function getModelInformation(ShowModelInformationRequest $request): ShowModelInformationResponse
    {
        $response = $this->client->post($this->url, $request->getPayload());

        return ShowModelInformationResponse::fromResponse($response);

    }

}
