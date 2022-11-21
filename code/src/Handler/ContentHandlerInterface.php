<?php

declare(strict_types=1);

namespace App\Handler;

interface ContentHandlerInterface
{
    public function handle(string $content, string $host): array;
}
