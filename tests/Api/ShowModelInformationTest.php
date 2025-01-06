<?php

namespace Tests\Api;

use GuzzleHttp\Psr7\Response;
use Ollama\Api\ShowModelInformation;
use Ollama\Client\OllamaClient;
use Ollama\Requests\ShowModelInformationRequest;
use PHPUnit\Framework\TestCase;

class ShowModelInformationTest extends TestCase
{
    public function testShowModelInformation(): void
    {

        $client = $this->createMock(OllamaClient::class);
        $client
            ->expects($this->once())
            ->method('post')
            ->willReturn(
                new Response(200, [], file_get_contents(__DIR__ . '/../testdata/show-model-information-response.json'))
            );

        $api = new ShowModelInformation($client);

        $response = $api->getModelInformation(new ShowModelInformationRequest(model: 'gemma2:latest'));

        self::assertEquals(expected: 'license', actual: $response->license);

    }

}
