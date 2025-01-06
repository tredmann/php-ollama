<?php

namespace Ollama;

use Exception;
use Ollama\Api\ChatCompletion;
use Ollama\Api\Completion;
use Ollama\Client\OllamaClient;
use Ollama\DTOs\Message;
use Ollama\Requests\ChatCompletionRequest;
use Ollama\Requests\CompletionRequest;

class Ollama
{
    private OllamaClient $client;
    private Completion $completion;
    private ChatCompletion $chatCompletion;

    public function __construct(private string $model, private readonly ?string $baseUrl = 'http://localhost:11434')
    {
        $this->client = new OllamaClient($this->baseUrl);
        $this->completion = new Completion($this->client);
        $this->chatCompletion = new ChatCompletion($this->client);
    }

    public function model(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function completion(string $prompt): string
    {
        $response = $this->completion->getCompletion(new CompletionRequest(model: $this->model, prompt: $prompt));

        return $response->response;
    }

    /**
     * @param array<Message> $messages
     * @return Message
     * @throws Exception
     */
    public function chat(array $messages): Message
    {
        $response = $this->chatCompletion
            ->getChatCompletion(
                new ChatCompletionRequest(
                    model: $this->model,
                    messages: $messages,
                )
            );

        return $response->message;
    }

}
