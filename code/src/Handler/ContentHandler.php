<?php

declare(strict_types=1);

namespace App\Handler;

use Symfony\Component\DomCrawler\Crawler;

class ContentHandler implements ContentHandlerInterface
{
    private const ALLOWED_FILE_EXTENSIONS = ['.jpg', '.png'];

    public function handle(string $content, string $host): array
    {
        $images = [];

        $crawler = new Crawler($content);
        foreach ($crawler->filter('img') as $imageNode) {
            $src = $imageNode->attributes->getNamedItem('src');
            if ($src) {
                $imageSrc = $src->nodeValue;
                if ($this->isImage($imageSrc)) {
                    $images[] = ['src' => $this->addHost($imageSrc, $host)];
                }
            }
        }

        return $images;
    }

    private function isImage(string $imageSrc): bool
    {
        foreach (self::ALLOWED_FILE_EXTENSIONS as $ext) {
            if (str_contains($imageSrc, $ext)) {
                return true;
            }
        }

        return false;
    }

    private function addHost(string $imageSrc, string $host): string
    {
        if (str_starts_with($imageSrc, '/')) {
            return $host . $imageSrc;
        }

        return $imageSrc;
    }
}