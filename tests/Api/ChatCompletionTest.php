<?php

namespace Tests\Api;

use GuzzleHttp\Psr7\Response;
use Ollama\Api\ChatCompletion;
use Ollama\Client\OllamaClient;
use Ollama\DTOs\Message;
use Ollama\Enums\Role;
use Ollama\Requests\ChatCompletionRequest;
use Ollama\Responses\ChatCompletionResponse;
use PHPUnit\Framework\TestCase;

class ChatCompletionTest extends TestCase
{
    public function testChatCompletion(): void
    {
        $client = $this->createMock(OllamaClient::class);
        $client
            ->expects($this->once())
            ->method('post')
            ->willReturn(
                new Response(200, [], file_get_contents(__DIR__ . '/../testdata/chat-completion-response.json'))
            );

        $api = new ChatCompletion($client);

        $request = new ChatCompletionRequest(
            model: 'gemma2:latest',
            messages: [
                new Message(role: Role::User, content: 'What is the capitol of Germany?')
            ]
        );

        $response = $api->getChatCompletion($request);

        self::assertInstanceOf(ChatCompletionResponse::class, $response);
        self::assertEquals(expected: "The capital of Germany is **Berlin**.", actual: $response->message->content);
        self::assertEquals(expected: Role::Assistant, actual: $response->message->role);
    }

}
