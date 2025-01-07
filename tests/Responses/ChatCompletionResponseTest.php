<?php

namespace Responses;

use Ollama\DTOs\Message;
use Ollama\Enums\Role;
use Ollama\Responses\ChatCompletionResponse;
use PHPUnit\Framework\TestCase;

class ChatCompletionResponseTest extends TestCase
{
    public function testFromJson(): void
    {
        $json = json_decode(file_get_contents(__DIR__ . '/../testdata/chat-completion-response.json'));

        $response = ChatCompletionResponse::fromJson($json);

        self::assertInstanceOf(expected: ChatCompletionResponse::class, actual: $response);

        self::assertTrue($response->done);
        self::assertEquals(expected: 'gemma2:latest', actual: $response->model);
        self::assertEquals(expected: 1550456000, actual: $response->totalDuration);
        self::assertEquals(expected: 842999542, actual: $response->loadDuration);
        self::assertEquals(expected: 16, actual: $response->promptEvalCount);
        self::assertEquals(expected: 457000000, actual: $response->promptEvalDuration);
        self::assertEquals(expected: 11, actual: $response->evalCount);
        self::assertEquals(expected: 248000000, actual: $response->evalDuration);

        self::assertInstanceOf(expected: Message::class, actual: $response->message);
        self::assertEquals(expected: Role::Assistant, actual: $response->message->role);
        self::assertEquals(expected: 'The capital of Germany is **Berlin**.', actual: $response->message->content);
    }

}
