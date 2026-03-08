<?php

namespace App\Repository;

abstract class BaseRepository
{
    /**
     * @return string
     */
    abstract public static function getTableName(): string;

    /**
     * @return array<string>
     */
    public static function getSelectedParams(): array
    {
        return [
            static::getTableName() . '.id'
        ];
    }
}