<?php

declare(strict_types=1);

namespace App\Validators;

use App\Validators\Interfaces\ValidateInterface;
use Exception;

class ValidateContext
{
    private ValidateInterface $validator;

    public function setValidator(ValidateInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function validate(array $params): void
    {
        if (!$this->validator) {
            throw new Exception("The validator is not installed");
        }

        $this->validator->validate($params);
    }

    public function getErrors(): array
    {
        return $this->validator->getErrors() ?? [];
    }
}
