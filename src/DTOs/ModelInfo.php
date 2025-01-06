<?php

namespace Ollama\DTOs;

readonly class ModelInfo
{
    /**
     * Since the model info varies for each model, we will just hold all the info as an array
     */
    public function __construct(public array $info)
    {
    }

}
