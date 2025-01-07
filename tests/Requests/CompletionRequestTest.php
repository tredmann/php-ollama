<?php

namespace Tests\Requests;

use Ollama\Requests\CompletionRequest;
use PHPUnit\Framework\TestCase;

class CompletionRequestTest extends TestCase
{
    public function testGetPayload(): void
    {
        $request = new CompletionRequest(
            model: 'testmodel',
            prompt: 'Testprompt',
            stream: false,
            options: [ 'temperature' => 1 ],
            format: 'json',
            system: 'systemprompt',
            template: 'template',
            raw: false,
            keepAlive: '5m',
            suffix: 'suffix',
        );

        self::assertEquals(
            expected:
            [
               'model' => 'testmodel',
            'prompt' => 'Testprompt',
            'stream' => false,
            'options' => [ 'temperature' => 1 ],
            'format' => 'json',
            'system' => 'systemprompt',
            'template' => 'template',
            'raw' => false,
            'keep_alive' => '5m',
            'suffix' => 'suffix',
            ],
            actual: $request->getPayload()
        );
    }

    public function testStreamSupportException(): void
    {
        $this->expectExceptionMessage('We currently do not support streaming.');

        $request = new CompletionRequest(
            model: 'testmodel',
            prompt: 'Testprompt',
            stream: true,
            options: [ 'temperature' => 1 ],
            format: 'json',
            system: 'systemprompt',
            template: 'template',
            raw: false,
            keepAlive: '5m',
            suffix: 'suffix',
        );

    }

}
