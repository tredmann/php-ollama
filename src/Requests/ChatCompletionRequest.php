<?php

namespace Ollama\Requests;

use Exception;
use Ollama\DTOs\Message;

readonly class ChatCompletionRequest
{
    /**
     * @param array<Message> $messages
     * @throws Exception
     */
    public function __construct(
        public string $model,
        public array $messages,
        public array $options = [],
        public ?array $images = null,
        public ?array $tools = null,
        public ?string $format = null,
        public ?bool $stream = false,
        public ?string $keepAlive = '5m',
    ) {

        // we currently not support streaming
        if ($this->stream === true) {
            throw new Exception(
                message: 'We currently do not support streaming.',
            );
        }
    }

    public function getPayload(): array
    {
        $payload = [
            'model' => $this->model,
            'stream' => $this->stream,
            'messages' => [],
        ];

        if ($this->keepAlive !== null) {
            $payload['keep_alive'] = $this->keepAlive;
        }

        if (count($this->options) > 0) {
            $payload['options'] = $this->options;
        }

        if ($this->format !== null) {
            $payload['format'] = $this->format;
        }

        if ($this->tools !== null) {
            $payload['tools'] = $this->tools;
        }

        foreach ($this->messages as $message) {
            $payload['messages'][] = [
                'role' => $message->role->value,
                'content' => $message->content,
            ];
        }

        return $payload;
    }

}
