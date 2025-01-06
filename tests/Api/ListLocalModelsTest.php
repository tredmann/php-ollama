<?php

namespace Api;

use GuzzleHttp\Psr7\Response;
use Ollama\Api\ListLocalModels;
use Ollama\Client\OllamaClient;
use PHPUnit\Framework\TestCase;

class ListLocalModelsTest extends TestCase
{
    public function testListLocalModels(): void
    {
        $client = $this->createMock(OllamaClient::class);
        $client->expects($this->once())
            ->method('get')
            ->willReturn(
                new Response(200, [], file_get_contents(__DIR__ . '/../testdata/list-local-models-response.json'))
            );

        $api = new ListLocalModels($client);

        $result = $api->listLocalModels();

        self::assertCount(expectedCount: 3, haystack: $result->models);

    }

}
