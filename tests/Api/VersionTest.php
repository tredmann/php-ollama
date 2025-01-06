<?php

namespace Api;

use GuzzleHttp\Psr7\Response;
use Ollama\Api\Version;
use Ollama\Client\OllamaClient;
use PHPUnit\Framework\TestCase;

class VersionTest extends TestCase
{
    public function testVersion(): void
    {
        $client = $this->createMock(OllamaClient::class);
        $client->expects($this->once())
            ->method('get')
            ->willReturn(new Response(200, [], file_get_contents(__DIR__.'/../testdata/version-response.json')));

        $api = new Version(client: $client);

        $response = $api->getVersion();

        self::assertEquals(expected: '0.5.4', actual: $response->version);
    }

}
