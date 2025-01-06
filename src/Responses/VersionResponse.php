<?php

namespace Ollama\Responses;

final readonly class VersionResponse extends AbstractResponse
{
    public function __construct(public string $version)
    {
    }

    public static function fromJson(object $json): static
    {
        return new static(version: $json->version);
    }

}
