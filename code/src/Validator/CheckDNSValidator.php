<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CheckDNSValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        $host = parse_url($value, PHP_URL_HOST);
        if (!checkdnsrr($host)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}