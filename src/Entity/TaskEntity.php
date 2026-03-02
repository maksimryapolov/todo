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
        public readonly string $deadline,
        public readonly int $statusId,
        public readonly DateTime $createdAt,
        private ?StatusEntity $status = null,
        private ?int $id = null
    ) {
    }

    public static function createNew(
        string $name,
        string $description,
        string $deadline,
        int $statusId,
        ?StatusEntity $status = null
    ): self {
        if (
            empty($name) ||
            empty($description) ||
            empty($deadline)
        ) {
            throw new InvalidArgumentException("One of the parameters is empty");
        }

        return new self(
            name: $name,
            description: $description,
            deadline: $deadline,
            status: $status,
            createdAt: new DateTime('now'),
            statusId: $statusId
        );
    }

    /**
     * @param array{
     *  id: int,
     *  title: string,
     *  description: string,
     *  created_at: DateTime,
     *  deadline: string,
     *  statusId: int
     * } $data
     *
     * @return array<TaskEntity>
     */
    public static function initFromArray(array $data): array
    {
        return array_map(static function($item) {
                return new self(
                    name: $item['title'],
                    description: $item['description'],
                    deadline: $item['deadline'],
                    statusId: (int)$item['statusId'],
                    createdAt: (new DateTime($item['created_at'])),
                    id: (int)$item['id']
                );
            },
            $data
        ) ?? [];
    }

    /** @return int */
    public function getStatusId(): int
    {
        return $this->statusId ?? 0;
    }

    /**
     * @param StatusEntity $status
     *
     * @return void
     */
    public function setStatus(StatusEntity $status): void
    {
        $this->status = $status;
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
        return $this->deadline;
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
