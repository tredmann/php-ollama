<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ollama\Ollama;

$ollama = new Ollama(model: 'gemma2:latest');

echo $ollama->completion(prompt: 'What is the capitol of Germany?');
