<?php

namespace App\Validators;

use Exception;
use App\Validators\Interfaces\ValidateInterface;

class ValidateContext
{
    private ValidateInterface $validator;

    public function setValidator(ValidateInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $params)
    {
        if(!$this->validator) {
            throw new Exception("The validator is not installed");
        }

        $this->validator->validate($params);
    }

    public function getErrors(): array
    {
        return $this->validator->getErrors() ?? [];
    }
}