<?php

namespace Ollama\Responses;

use Ollama\DTOs\Message;
use Ollama\Enums\Role;

final readonly class ChatCompletionResponse extends AbstractResponse
{
    /**
     * Why are all the int nullable? When streaming, we will get the data in the final response, so
     * it is not available while the response is still streamed
     */
    public function __construct(
        public string $model,
        public Message $message,
        public bool $done,
        public ?int $totalDuration = null,
        public ?int $loadDuration = null,
        public ?int $promptEvalCount = null,
        public ?int $promptEvalDuration = null,
        public ?int $evalCount = null,
        public ?int $evalDuration = null,
    ) {

    }

    public static function fromJson(object $json): static
    {
        return new static(
            model: $json->model,
            message: new Message(role: Role::from($json->message->role), content: $json->message->content),
            done: $json->done,
            totalDuration: $json->total_duration ?? null,
            loadDuration: $json->load_duration ?? null,
            promptEvalCount: $json->prompt_eval_count ?? null,
            promptEvalDuration: $json->prompt_eval_duration ?? null,
            evalCount: $json->eval_count ?? null,
            evalDuration: $json->eval_duration ?? null,
        );
    }
}
