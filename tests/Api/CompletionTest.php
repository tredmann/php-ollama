<?php

namespace Tests\Api;

use GuzzleHttp\Psr7\Response;
use Ollama\Api\Completion;
use Ollama\Client\OllamaClient;
use Ollama\Requests\CompletionRequest;
use PHPUnit\Framework\TestCase;

class CompletionTest extends TestCase
{
    public function testCompletion()
    {
        $client = $this->createMock(OllamaClient::class);
        $client
            ->expects($this->once())
            ->method('post')
            ->willReturn(
                new Response(200, [], file_get_contents(__DIR__ . '/../testdata/completion.json'))
            );

        $completion = new Completion($client);

        $response = $completion->getCompletion(
            new CompletionRequest(
                model: 'phi3.5:latest',
                prompt: 'What is the capitol of Germany?'
            )
        );

        self::assertNotNull($response);
        self::assertEquals('The capitol of Germany is Berlin', $response->response);
    }

}
