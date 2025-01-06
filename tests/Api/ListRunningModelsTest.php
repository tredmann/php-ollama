<?php

namespace Tests\Api;

use GuzzleHttp\Psr7\Response;
use Ollama\Api\ListRunningModels;
use Ollama\Client\OllamaClient;
use PHPUnit\Framework\TestCase;

class ListRunningModelsTest extends TestCase
{
    public function testListRunningModels(): void
    {
        $client = $this->createMock(OllamaClient::class);
        $client->expects($this->once())
            ->method('get')
            ->willReturn(new Response(200, [], file_get_contents(__DIR__.'/../testdata/list-running-models-response.json')));

        $api = new ListRunningModels($client);

        $response = $api->getRunningModels();

        self::assertCount(expectedCount: 1, haystack: $response->models);
    }

}
