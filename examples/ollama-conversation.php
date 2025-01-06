<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ollama\DTOs\Message;
use Ollama\Enums\Role;
use Ollama\Ollama;

$ollama = new Ollama(model: 'gemma2:latest');

$messages = [];

// initial question where the answer will be Paris
$messages[] =  new Message(role: Role::User, content: "What is the capitol of France");

$message = $ollama->chat($messages);

// the first answer Paris
echo $message->content;

$messages[] = $message;

// follow-up question where Paris should be considered
$messages[] = new Message(
    role: Role::User,
    content: "How many people live there within the official numbers within the city limits?"
);

$answer = $ollama->chat($messages);

// answer
echo $answer->content;
