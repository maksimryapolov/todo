<?php
namespace App\Entity;

use DateTime;

class TaskEntity
{
    public function __construct(
        readonly string $name,
        readonly string $description,
        readonly string $date,
        readonly string $status,
        readonly DateTime $createdAt,
        readonly ?int $id = null
    )
    {}

    public static function createNew(
        string $name,
        string $description,
        string $date,
        string $status
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

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }
}
