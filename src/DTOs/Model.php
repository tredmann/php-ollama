<?php

namespace Ollama\DTOs;

readonly class Model
{

//"name": "codellama:13b",
//"modified_at": "2023-11-04T14:56:49.277302595-07:00",
//"size": 7365960935,
//"digest": "9f438cb9cd581fc025612d27f7c1a6669ff83a8bb0ed86c94fcf4c5440555697",
//"details": {
//"format": "gguf",
//"family": "llama",
//"families": null,
//"parameter_size": "13B",
//"quantization_level": "Q4_0"
//}

    public function __construct(
        public string    $name,
        public \DateTime $modifiedAt,
        public int       $size,
        public string    $digest,
        public Details   $details,
    ) {}

}