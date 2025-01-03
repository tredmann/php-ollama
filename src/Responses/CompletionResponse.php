<?php

namespace Ollama\Responses;

use Psr\Http\Message\ResponseInterface;

class CompletionResponse
{
    public function __construct(
        public string $model,
        public string $response,
        public bool $done = true,
    ) {

    }

    public static function fromResponse(ResponseInterface $response): self
    {
        $body = $response->getBody()->getContents();

        $json = json_decode($body);

        return new self(
            model: $json->model,
            response: $json->response,
            done: $json->done
        );
    }

}
