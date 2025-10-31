<?php

namespace App\Entity;

use App\Repository\StatusRepository;

class StatusEntityNew
{
    private static array $statuses = ['new' => 'new', 'in_progress' => 'in progress', 'done' => 'done'];

    public static function getList(): array
    {
        return self::$statuses;
    }

    public static function getStatusNew(): string
    {
        return self::$statuses['new'];
    }

    public static function getStatusDone(): string
    {
        return self::$statuses['done'];
    }

    public static function getStatusInProgress(): string
    {
        return self::$statuses['in_progress'];
    }
}

class StatusEntity
{
    private static array $statuses = ['new' => 'new', 'in_progress' => 'in progress', 'done' => 'done'];

    public function __construct(
        public StatusRepository $statusRepository
    ) {}

    public function getList(): array
    {
        return self::$statuses;
    }

    public function getStatusNew(): string
    {
        $this->statusRepository->getStatusByCode('new');
        return self::$statuses['new'];
    }

    public function getStatusDone(): string
    {
        return self::$statuses['done'];
    }

    public function getStatusInProgress(): string
    {
        return self::$statuses['in_progress'];
    }
}
