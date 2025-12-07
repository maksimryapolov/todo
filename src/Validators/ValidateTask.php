<?php
namespace App\Validators;

use App\Validators\Interfaces\ValidateInterface;

class ValidateTask implements ValidateInterface
{
    private array $errors = [];
    /**
     * @param array {
     *    name: string,
     *    date: string
     * } $params
     * @return void
     */
    public function validate(array $params): void
    {
        if(!isset($params['name']) || empty($params['name']) || strlen($params['name']) <= 1) {
            $this->errors[] = 'Name is required and must be at least 2 characters long';
        }

        if(!$params['date']) {
            $this->errors[] = 'Date is required';
        }

        $date = $params['date'];
        if (!preg_match('/^(\d{4})\-(\d{2})\-(\d{2})$/', $date, $matches)) {
            $this->errors[] = 'The date is not a valid format.';
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

class ValidateName
{
    private string $error;

    public function validate(string $name): bool
    {
        if(!$name && strlen($name) <= 1) {
            $this->error = 'Name is required and must be at least 2 characters long';
        }
    }

    public function getError(): string
    {
        return $this->error ?? '';
    }
}

class ValidateRulesTask
{
    public function getRules(): array
    {
        return [
            'name' => '',
            'description' => '',
            'date' => ''
        ];
    }

    public function validateName($name)
    {
        $validate = new ValidateName();
        $validate->$validate($name);
    }
}
