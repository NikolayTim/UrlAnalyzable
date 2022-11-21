<?php

declare(strict_types=1);

namespace App\Service;

use App\Client\UrlClientInterface;
use App\DTO\Input\UrlDto;
use App\DTO\Output\ImagesDto;
use App\Handler\ContentHandlerInterface;

class UrlAnalyzableService implements UrlAnalyzableInterface
{
    private const HTTP_METHOD = 'GET';

    public function __construct(private UrlClientInterface $urlClient, private ContentHandlerInterface $contentHandler) {}

    public function process(UrlDto $urlDto): ImagesDto
    {
        $content = $this->urlClient
            ->request(self::HTTP_METHOD, $urlDto->url)
            ->getBody()
            ->getContents();

        $host = parse_url($urlDto->url, PHP_URL_HOST);
        $images = $this->contentHandler->handle($content, $host);

        foreach ($images as $key => $image) {
            $images[$key]['size'] = $this->urlClient
                ->request(self::HTTP_METHOD, $image['src'])
                ->getBody()
                ->getSize();
        }

        return ImagesDto::create($images);
    }
}