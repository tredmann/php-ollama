# PHP Ollama

PHP Client Library to interact with Ollama API.



This package contains some low-level API libraries as well as a convenient API wrapper for all APIs. 

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
    prompt: 'What is the capital of Germany?' 
);
```

### Use a request to query the API

```php
$response = $completionApi->getCompletion(request: $request);
```

### Use the response

```php
echo $response->response;
// 'The capital of Germany is Berlin.'
```
