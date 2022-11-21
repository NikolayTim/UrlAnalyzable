<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Input\UrlDto;
use App\DTO\Output\ImagesDto;

interface UrlAnalyzableInterface
{
    public function process(UrlDto $urlDto): ImagesDto;
}