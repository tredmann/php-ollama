<?php

namespace Ollama\Requests;

readonly class ShowModelInformationRequest
{
    public function __construct(
        public string $model,
        public ?bool $verbose = false
    ) {
    }

    public function getPayload(): array
    {
        return [
            'model' => $this->model,
            'verbose' => $this->verbose,
        ];
    }

}
