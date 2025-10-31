<?php
namespace App\Validators;


class ValidateTask
{
    /**
     * @param array {
     *    name: string,
     *    date: string
     * } $params
     * @return void
     */
    public function validate(array $params): void
    {
        if(!$params['name'] && strlen($params['name']) <= 1) {
            throw new \Exception('Name is required and must be at least 2 characters long');
        }

        if(!$params['date']) {
            throw new \Exception('Date is required');
        }
    }
}


