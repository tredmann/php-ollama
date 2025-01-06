<?php

namespace Ollama\Responses;

use Ollama\DTOs\Details;
use Ollama\DTOs\ModelInfo;

readonly class ShowModelInformationResponse extends AbstractResponse
{
    public function __construct(
        public string $modelFile,
        public string $parameters,
        public string $template,
        public Details $details,
        public ModelInfo $modelInfo,
        public ?string $license = null,
    ) {
    }

    public static function fromJson(object $json): static
    {
        return new self(
            modelFile: $json->modelfile,
            parameters: $json->parameters,
            template: $json->template,
            details: new Details(
                format: $json->details->format,
                family: $json->details->family,
                parameterSize: $json->details->parameter_size,
                quantizationLevel: $json->details->quantization_level,
                families: $json->details->families,
            ),
            modelInfo: new ModelInfo(info: (array) $json->model_info),
            license: $json->license ?? null,
        );

    }
}
