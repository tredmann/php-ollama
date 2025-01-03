<?php

readonly class CompletionRequest
{

    public function __construct(
        public string $model,
        public string $prompt,
        public ?string $suffix,
        public ?bool $stream = false,
    ) {}

}