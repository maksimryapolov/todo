<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use InvalidArgumentException;

class TaskEntity implements IEntity
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $date,
        public readonly StatusEntity $status,
        public readonly DateTime $createdAt,
        private ?int $id = null
    ) {
    }

    public static function createNew(
        string $name,
        string $description,
        string $date,
        StatusEntity $status
    ): self {
        if (
            empty($name) ||
            empty($description) ||
            empty($date)
        ) {
            throw new InvalidArgumentException("One of the parameters is empty");
        }

        return new self(
            name: $name,
            description: $description,
            date: $date,
            status: $status,
            createdAt: new DateTime('now')
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getStatus(): StatusEntity
    {
        return $this->status;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function createdAtToString(string $format = 'd.m.Y'): string
    {
        if ($this->createdAt instanceof DateTime) {
            return $this->createdAt->format($format);
        }
        return '';
    }

    public function getCode(): string
    {
        return "";
    }
}
