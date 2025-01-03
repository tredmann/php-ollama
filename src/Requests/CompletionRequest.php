<?php

namespace Ollama\Requests;

readonly class CompletionRequest
{
    public function __construct(
        public string $model,
        public string $prompt,
        public ?string $suffix = null,
        public ?bool $stream = false,
    ) {
    }

    public function getPayload(): array
    {
        return [
            'model' => $this->model,
            'prompt' => $this->prompt,
            'stream' => $this->stream,
        ];
    }

}
