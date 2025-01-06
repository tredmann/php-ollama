<?php

namespace Ollama\Responses;

readonly class VersionResponse extends AbstractResponse
{
    public function __construct(public string $version)
    {
    }

    public static function fromJson(object $json): static
    {
        return new self(version: $json->version);
    }

}
