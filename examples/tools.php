<?php

require_once __DIR__.'/../vendor/autoload.php';

use Ollama\Api\ChatCompletion;
use Ollama\Client\OllamaClient;
use Ollama\DTOs\Message;
use Ollama\Enums\Role;
use Ollama\Requests\ChatCompletionRequest;

$client = new OllamaClient();

$chat = new ChatCompletion($client);


$tool = new stdClass();
$tool->type = 'function';
$tool->function = new stdClass();
$tool->function->name = "get_stock_price";
$tool->function->description = "Get the current stock price for a company by name NOT ticket symbol";
$tool->function->parameters = new stdClass();
$tool->function->parameters->type = "object";
$tool->function->parameters->properties = new stdClass();
$tool->function->parameters->properties->company = new stdClass();
$tool->function->parameters->properties->company->type = "string";
$tool->function->parameters->properties->company->description = "The company name NOT ticker symbol";
$tool->function->required = ['company'];


$tools = [$tool];

$messages = [new Message(
    role: Role::User,
    content: 'What is the current stock price of Microsoft'
)];

$toolRequest = new ChatCompletionRequest(
    model: 'llama3.2:latest',
    messages: $messages,
    options: [
        'temperature' => 1
    ],
    tools: $tools
);

$response = $chat->getChatCompletion($toolRequest);

$messages[] = $response->message;

if ($response->message->toolCalls !== null) {
    $messages[] = new Message(
        role: Role::Tool,
        content: '$ 143 as of '. date(DATE_RFC822)
    );
}

$response2 = $chat->getChatCompletion(new ChatCompletionRequest(
    model: 'llama3.2:latest',
    messages: $messages,
    options: ['temperature' => 1],
    tools: $tools
));

echo $response2->message->content;
