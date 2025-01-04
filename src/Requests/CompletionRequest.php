<?php

namespace Ollama\Requests;

readonly class CompletionRequest
{
    /**
     * @url: https://github.com/ollama/ollama/blob/main/docs/api.md#parameters
     */
    public function __construct(
        public string $model,
        public string $prompt,
        public bool $stream = false,
        public ?array $options = [],
        public ?string $format = null,
        public ?string $system = null,
        public ?string $template = null,
        public ?bool $raw = false,
        public ?string $keepAlive = '5m',
        public ?string $suffix = null,
    ) {
    }

    /**
     * Will return the correct formatted payload with keys and values for the
     * request to Ollama
     */
    public function getPayload(): array
    {
        $payload = [
            'model' => $this->model,
            'prompt' => $this->prompt,
            'stream' => $this->stream,
            'options' => $this->options,
            'raw' => $this->raw,
            'keep_alive' => $this->keepAlive,
        ];

        if ($this->format !== null) {
            $payload['format'] = $this->format;
        }

        if ($this->system !== null) {
            $payload['system'] = $this->system;
        }

        if ($this->template !== null) {
            $payload['template'] = $this->template;
        }

        if ($this->suffix !== null) {
            $payload['suffix'] = $this->suffix;
        }

        return $payload;
    }

}
