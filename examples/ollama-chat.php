<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ollama\DTOs\Message;
use Ollama\Enums\Role;
use Ollama\Ollama;

$ollama = new Ollama(model: 'gemma2:latest');

$message = $ollama->chat(
    [
        new Message(role: Role::User, content: "What is the capitol of France")
    ]
);

echo $message->content;
