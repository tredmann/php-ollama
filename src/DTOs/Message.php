<?php

namespace Ollama\DTOs;

use Ollama\Enums\Role;

readonly class Message
{
    public function __construct(
        public Role $role,
        public string $content,
        public ?array $images = null,
        public ?array $toolCalls = null,
    ) {
    }

}
