<?php

declare(strict_types=1);

namespace Conveycode\PhpunitExercices\ExerciceEmailValidator;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Client\RequestExceptionInterface;

final class EmailValidator
{
    public function __construct(private readonly Client $client)
    {
    }

    public function validate(string $email): bool
    {
        try {
            $response = $this->client->request('GET', 'https://email.verify/' . $email);
        } catch (RequestExceptionInterface $e) {
            return false;
        }

        $body = (array)json_decode($response->getBody()->getContents(), true);

        return isset($body['format']) && $body['format'] === true;
    }
}
