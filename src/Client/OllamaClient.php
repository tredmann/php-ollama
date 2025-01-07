<?php

namespace Ollama\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class OllamaClient
{
    private Client $client;

    public function __construct(
        public string $baseUrl = 'http://localhost:11434',
    ) {
        $this->client = new Client(['base_uri' => $this->baseUrl]);
    }

    /**
     * @throws GuzzleException
     */
    public function post(string $url, array $json = []): ResponseInterface
    {
        return $this->client->post($url, ['json' => $json]);
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $url, array $params = []): ResponseInterface
    {
        $options = [];

        if (count($params) > 0) {
            $options['query'] = $params;
        }

        return $this->client->get($url, $options);
    }
}
