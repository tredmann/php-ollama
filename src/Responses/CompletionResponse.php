<?php

namespace Ollama\Responses;

use DateMalformedStringException;
use DateTime;
use JsonException;
use Psr\Http\Message\ResponseInterface;

class CompletionResponse
{
    public function __construct(
        public string $model,
        public string $response,
        public bool $done,
        public ?DateTime $createdAt,
        public ?array $context = null,
        public ?int $totalDuration = null,
        public ?int $loadDuration = null,
        public ?int $promptEvalCount = null,
        public ?int $promptEvalDuration = null,
        public ?int $evalCount = null,
        public ?int $evalDuration = null,
    ) {

    }

    /**
     * @throws DateMalformedStringException
     */
    public static function fromJson(object $json): self
    {
        return new self(
            model: $json->model,
            response: $json->response,
            done: $json->done,
            createdAt: new DateTime($json->created_at),
            context: $json->context ?? null,
            totalDuration: $json->total_duration ?? null,
            loadDuration: $json->load_duration ?? null,
            promptEvalCount: $json->prompt_eval_count ?? null,
            promptEvalDuration: $json->prompt_eval_duration ?? null,
            evalCount: $json->eval_count ?? null,
            evalDuration: $json->eval_duration ?? null,
        );
    }

    /**
     * @throws DateMalformedStringException
     * @throws JsonException
     */
    public static function fromResponse(ResponseInterface $response): self
    {
        $body = $response->getBody()->getContents();

        $json = json_decode(json: $body, flags: JSON_THROW_ON_ERROR);

        return self::fromJson($json);
    }

}
