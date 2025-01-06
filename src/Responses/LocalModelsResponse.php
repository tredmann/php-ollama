<?php

namespace Ollama\Responses;

use DateMalformedStringException;
use DateTime;
use GuzzleHttp\Psr7\Response;
use Ollama\DTOs\Details;
use Ollama\DTOs\Model;

readonly class LocalModelsResponse
{
    /**
     * @param array<Model> $models
     */
    public function __construct(public array $models)
    {
    }


    /**
     * @throws DateMalformedStringException
     */
    public static function fromJson(object $json): self
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

        return new self(models: $models);
    }

    /**
     * @throws DateMalformedStringException
     */
    public static function fromResponse(Response $response): self
    {
        $json = json_decode($response->getBody()->getContents());

        return self::fromJson($json);
    }

}
