<?php

namespace App\Entity;

class StatusEntity
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