<?php

namespace Ollama\Responses;

use Psr\Http\Message\ResponseInterface;

readonly class VersionResponse
{
    public function __construct(public string $version)
    {
    }

    public static function fromJson(object $json): self
    {
        return new self(version: $json->version);
    }


    public static function fromResponse(ResponseInterface $response): self
    {
        $json = json_decode($response->getBody()->getContents());

        return self::fromJson($json);
    }

}
