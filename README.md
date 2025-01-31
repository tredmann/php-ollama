# PHP Ollama

PHP Client Library to interact with Ollama API.

The intention is to work with models on your Ollama setup and not the create a delete models. Therefore,
this library will not implement any APIs to create, move or delete models. Here is a list of the APIs
we intend to implement and the status of the implementation:

* [x] Completion (without streaming support)
* [x] Chat Completion (without streaming support)
* [x] List local models
* [x] Show Model Information
* [x] List Running Models
* [x] Version

The checkout the [Ollama API Docs](https://github.com/ollama/ollama/blob/main/docs/api.md) for more information and the APIs we might miss.

This package contains some low-level API libraries as well as a convenient API wrapper for all APIs. 

## Installation
```shell
composer install tredmann/php-ollama
```


## Convenience Wrapper

The easiest way to ask the LLM things is to use the convenience wrapper:

```php
use Ollama\Ollama;

$ollama = new Ollama(model: 'gemma2:latest');

echo $ollama->completion(prompt: 'What is the capitol of Germany?');
// The capital of Germany is **Berlin**.

```

It does have a ton of limitations, but for quick results it is easy to use. I would highly encourage to look into
the low-level library.


## General way of working with the low-level library

### Creating the Client

```php
use Ollama\Client\OllamaClient;

$client = new OllamaClient(
    baseUrl: 'http://localhost:11434' // default
    );
```

### Inject the client into the respected API

```php
use Ollama\Api\Completion;

$completionApi = new Completion(client: $client);
```

### Use the API by creating an API request

```php
use Ollama\Requests\CompletionRequest;

$request = new CompletionRequest(
    model: 'phi3.5:latest',
    prompt: 'What is the capitol of Germany?' 
);
```

### Use a request to query the API

```php
$response = $completionApi->getCompletion(request: $request);
```

### Use the response

```php
echo $response->response;
// 'The capitol of Germany is Berlin.'
```
