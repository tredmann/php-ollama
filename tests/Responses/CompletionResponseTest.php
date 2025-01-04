<?php

namespace Tests\Responses;

use Ollama\Responses\CompletionResponse;
use PHPUnit\Framework\TestCase;

class CompletionResponseTest extends TestCase
{
    public function testFromJson(): void
    {
        $json = json_decode(file_get_contents(__DIR__ . '/../testdata/completion-response.json'));

        $completionResponse = CompletionResponse::fromJson($json);

        self::assertNotNull($completionResponse);
        self::assertInstanceOf(expected: CompletionResponse::class, actual: $completionResponse);

        self::assertInstanceOf(\DateTime::class, $completionResponse->createdAt);
    }

}
