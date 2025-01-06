<?php

namespace Ollama\Api;

use Ollama\Client\OllamaClient;
use Ollama\Requests\ChatCompletionRequest;
use Ollama\Responses\ChatCompletionResponse;

class ChatCompletion
{
    public function __construct(
        public OllamaClient $client,
        public string $url = '/api/chat'
    ) {

    }

    public function getChatCompletion(ChatCompletionRequest $request): ChatCompletionResponse
    {
        $response = $this->client->post($this->url, $request->getPayload());

        return ChatCompletionResponse::fromResponse($response);
    }

}
