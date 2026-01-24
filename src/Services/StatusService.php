<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\StatusEntity;
use App\Repository\StatusRepository;
use InvalidArgumentException;

class StatusService
{
    public const STATUS_NEW = 'new';

    public function __construct(
        private StatusRepository $statusRepository
    ) {
    }

    public function getStatusByCode(string $code): StatusEntity
    {
        if (!$code) {
            throw new InvalidArgumentException('Code is empty');
        }

        return $this->statusRepository->findStatusByCode($code);
    }

    public function getStatusNew(): StatusEntity
    {
        return $this->getStatusByCode(self::STATUS_NEW);
    }
}
