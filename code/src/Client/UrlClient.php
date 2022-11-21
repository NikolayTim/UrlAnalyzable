<?php

declare(strict_types=1);

namespace App\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class UrlClient implements UrlClientInterface
{
    private ClientInterface $client;

    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    public function request(string $method, string $url): ResponseInterface
    {
        return $this->client->request($method, $url);
    }
}