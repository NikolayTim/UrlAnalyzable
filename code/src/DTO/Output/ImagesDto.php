<?php

declare(strict_types=1);

namespace App\DTO\Output;

class ImagesDto
{
    public array $images;

    public function __construct(array $data)
    {
        $this->images = $data;
    }

    public static function create(array $data)
    {
        return new self($data);
    }
}