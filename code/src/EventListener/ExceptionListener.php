<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $response = new Response();
        $response->setContent(
            $event->getThrowable()->getMessage()
        );
        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        $event->setResponse($response);
    }
}