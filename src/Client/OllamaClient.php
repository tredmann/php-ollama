<?php

namespace Ollama\Client;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class OllamaClient
{
    private Client $client;

    public function __construct(
        public string $baseUrl = 'http://localhost:11434',
    ) {
        $this->client = new Client(['base_uri' => $this->baseUrl]);
    }

    public function post(string $url, array $json = []): ResponseInterface
    {
        return $this->client->post($url, ['json' => $json]);
    }
}
