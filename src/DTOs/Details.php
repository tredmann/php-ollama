<?php

namespace Ollama\DTOs;

readonly class Details
{
    public function __construct(
        public string $format,
        public string $family,
        public string $parameterSize,
        public string $quantizationLevel,
        public ?array $families = null,
    ) {
    }


}
