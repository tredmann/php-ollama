<?php

namespace Ollama\Responses;

use Ollama\DTOs\Model;
use Psr\Http\Message\ResponseInterface;

readonly class RunningModelsResponse
{
    /** @param array<Model> $models */
    public function __construct(public array $models)
    {
    }

    public static function fromResponse(ResponseInterface $response): self
    {
        return new self(models: []);
    }

}