<?php

namespace Ollama\Responses;

use DateMalformedStringException;
use DateTime;
use Ollama\DTOs\Details;
use Ollama\DTOs\Model;

final readonly class RunningModelsResponse extends AbstractResponse
{
    /** @param array<Model> $models */
    public function __construct(public array $models)
    {
    }

    /**
     * @throws DateMalformedStringException
     */
    public static function fromJson(object $json): static
    {
        $models = [];

        foreach ($json->models as $m) {

            $models[] = new Model(
                name: $m->name,
                modifiedAt: isset($m->modified_at) ? new DateTime($m->modified_at) : null,
                size: $m->size,
                digest: $m->digest,
                details: new Details(
                    format: $m->details->format,
                    family: $m->details->family,
                    parameterSize: $m->details->parameter_size,
                    quantizationLevel: $m->details->quantization_level,
                    families: $m->details->families,
                )
            );
        }

        return new static(models: $models);
    }
}
