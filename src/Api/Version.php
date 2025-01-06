<?php

namespace Ollama\Api;

use Ollama\Client\OllamaClient;
use Ollama\Responses\VersionResponse;

class Version
{
    public function __construct(
        public OllamaClient $client,
        public string $url = '/api/version'
    ) {

    }

    public function getVersion(): VersionResponse
    {
        $response = $this->client->get($this->url);

        return  VersionResponse::fromResponse($response);

    }

}
