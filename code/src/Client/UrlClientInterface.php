<?php

declare(strict_types=1);

namespace App\Client;

use Psr\Http\Message\ResponseInterface;

interface UrlClientInterface
{
    public function request(string $method, string $url): ResponseInterface;
}