<?php

namespace Ollama\Responses;

use Ollama\DTOs\Message;
use Ollama\Enums\Role;

final readonly class ChatCompletionResponse extends AbstractResponse
{
    public function __construct(
        public string $model,
        public Message $message,
        public bool $done
    ) {

    }


    public static function fromJson(object $json): static
    {

        return new static(
            model: $json->model,
            message: new Message(role: Role::from($json->message->role), content: $json->message->content),
            done: $json->done
        );
    }
}
