<?php

namespace App\Validators\Interfaces;

interface ValidateInterface
{
    public function validate(array $params): void;
    public function getErrors(): array;
}