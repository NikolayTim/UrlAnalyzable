<?php

declare(strict_types=1);

namespace App\DTO\Input;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AppAssert;

class UrlDto
{
    /**
     * @Assert\Url()
     * @AppAssert\CheckDNS()
     */
    public string $url;

    public function __construct(array $formData = [])
    {
        $this->url = $formData['url'] ?? '';
    }
}