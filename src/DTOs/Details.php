<?php

namespace Ollama\DTOs;

//"format": "gguf",
//"family": "llama",
//"families": null,
//"parameter_size": "13B",
//"quantization_level": "Q4_0"
readonly class Details
{
    public function __construct(
        public string $format,
        public string $family,
        public string $parameterSize,
        public string $quantizationLevel,
        public ?array $families = null,
    ) {}


}