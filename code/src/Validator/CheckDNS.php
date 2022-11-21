<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckDNS extends Constraint
{
    public string $message = 'Не найдены записи DNS для "{{ string }}".';
    public string $mode = 'strict';
}