<?php

namespace Requests;

use Ollama\DTOs\Message;
use Ollama\Enums\Role;
use Ollama\Requests\ChatCompletionRequest;
use PHPUnit\Framework\TestCase;

class ChatCompletionRequestTest extends TestCase
{
    public function testGetPayload(): void
    {
        $request = new ChatCompletionRequest(
            model: 'gemma2:latest',
            messages: [ new Message(role: Role::User, content: 'What is the capitol of Germany?')],
            options: ['temperature' => 1],
            images: null,
            tools: null,
            format: 'json',
            stream: false,
            keepAlive: '5m'
        );

        $payload = $request->getPayload();

        self::assertEquals(expected: 'gemma2:latest', actual: $payload['model']);
        self::assertFalse($payload['stream']);
        self::assertEquals(expected: ['temperature' => 1], actual: $payload['options']);
        self::assertEquals(expected: 'json', actual: $payload['format']);
        self::assertEquals(expected: '5m', actual: $payload['keep_alive']);

        self::assertCount(1, $payload['messages']);

        self::assertEquals(Role::User->value, $payload['messages'][0]['role']);
        self::assertEquals('What is the capitol of Germany?', $payload['messages'][0]['content']);
    }

    public function testStreamSupportException(): void
    {
        $this->expectExceptionMessage('We currently do not support streaming.');

        new ChatCompletionRequest(
            model: 'gemma2:latest',
            messages: [ new Message(role: Role::User, content: 'What is the capitol of Germany?')],
            stream: true
        );

    }
}
