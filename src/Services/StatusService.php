<?php
namespace App\Services;

use App\Repository\StatusRepository;

class StatusService
{
    const STATUS_NEW = 'new';

    public function __construct(
        private StatusRepository $statusRepository
    )
    {}

    public function getStatusByCode(string $code)
    {
        $this->statusRepository->getStatusByCode($code);
    }

    public function getNewStatus()
    {
        return $this->getStatusByCode(self::STATUS_NEW);
    }
}