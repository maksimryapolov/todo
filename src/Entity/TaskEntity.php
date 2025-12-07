<?php

namespace App\Entity;

use DateTime;

class TaskEntity
{
    public function __construct(
        readonly string $name,
        readonly string $description,
        readonly string $date,
        readonly StatusEntity $status,
        readonly DateTime $createdAt,
        private ?int $id = null
    )
    {}

    public static function createNew(
        string $name,
        string $description,
        string $date,
        StatusEntity $status
    ): self
    {
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
}
