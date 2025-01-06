<?php

namespace Ollama\Responses;

use JsonException;
use Psr\Http\Message\ResponseInterface;

abstract readonly class AbstractResponse
{
    abstract public static function fromJson(object $json): static;

    /**
     * @throws JsonException
     */
    public static function fromResponse(ResponseInterface $response): static
    {
        $json = json_decode(json: $response->getBody()->getContents(), flags: JSON_THROW_ON_ERROR);

        return static::fromJson($json);
    }
}
