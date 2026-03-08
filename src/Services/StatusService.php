<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\StatusEntity;
use App\Repository\StatusRepository;
use InvalidArgumentException;

class StatusService
{
    public const STATUS_NEW = 'new';
    public const STATUS_PROGRESS = 'progress';
    public const STATUS_COMPLETED = 'completed';

    /**
     * @param StatusRepository $statusRepository
     */
    public function __construct(
        private StatusRepository $statusRepository
    ) {
    }

    /**
     * @param array<int> $ids
     *
     * @return array<StatusEntity>
     */
    public function getStatusByIds(array $ids): array
    {
        $result = [];

        foreach($ids as $id) {
            $result[$id] = $this->getById($id);
        }

        return $result;
    }

    /**
     * @param int $id
     *
     * @return StatusEntity
     */
    public function getById(int $id): StatusEntity
    {
        if(!$id) {
            throw new InvalidArgumentException("status ID is empty");
        }

        return $this->statusRepository->getById($id);
    }

    /**
     * @param string $code
     *
     * @return StatusEntity
     */
    public function getStatusByCode(string $code): StatusEntity
    {
        if (!$code) {
            throw new InvalidArgumentException('Code is empty');
        }

        return $this->statusRepository->findStatusByCode($code);
    }

    /**
     * @return StatusEntity
     */
    public function getStatusNew(): StatusEntity
    {
        return $this->getStatusByCode(self::STATUS_NEW);
    }

    /**
     * @return StatusEntity
     */
    public function getStatusProgress(): StatusEntity
    {
        return $this->getStatusByCode(self::STATUS_PROGRESS);
    }

    /**
     * @return StatusEntity
     */
    public function getStatusCompleted(): StatusEntity
    {
        return $this->getStatusByCode(self::STATUS_COMPLETED);
    }
}
