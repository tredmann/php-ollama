<?php

namespace Tests\Responses;

use DateTime;
use Ollama\Responses\CompletionResponse;
use PHPUnit\Framework\TestCase;

class CompletionResponseTest extends TestCase
{
    public function testFromJson(): void
    {
        $json = json_decode(file_get_contents(filename: __DIR__ . '/../testdata/completion-response.json'));

        $completionResponse = CompletionResponse::fromJson($json);

        self::assertNotNull($completionResponse);
        self::assertInstanceOf(expected: CompletionResponse::class, actual: $completionResponse);

        self::assertInstanceOf(expected: DateTime::class, actual: $completionResponse->createdAt);
        self::assertEquals(expected: '2023-08-04 19:22:45', actual: $completionResponse->createdAt->format('Y-m-d H:i:s'));

        self::assertEquals(expected: [1,2,3], actual: $completionResponse->context);

        self::assertTrue($completionResponse->done);

        self::assertEquals(expected: 'llama3.2', actual: $completionResponse->model);

        self::assertEquals(
            expected: 'The sky is blue because it is the color of the sky.',
            actual: $completionResponse->response
        );

        self::assertEquals(expected: 5043500667, actual: $completionResponse->totalDuration);
        self::assertEquals(expected: 5025959, actual: $completionResponse->loadDuration);
        self::assertEquals(expected: 26, actual: $completionResponse->promptEvalCount);
        self::assertEquals(expected: 325953000, actual: $completionResponse->promptEvalDuration);
        self::assertEquals(expected: 290, actual: $completionResponse->evalCount);
        self::assertEquals(expected: 4709213000, actual: $completionResponse->evalDuration);
    }

}
