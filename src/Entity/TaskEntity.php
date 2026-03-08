<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use InvalidArgumentException;

class TaskEntity implements IEntity
{
    /**
     * @param string $name
     * @param string $description
     * @param string $date
     * @param StatusEntity $status
     * @param DateTime $createdAt
     * @param integer|null $id
     */
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

    /**
     * @param string $name
     * @param string $description
     * @param string $date
     * @param StatusEntity $status
     * @return self
     *
     * @throws InvalidArgumentException
     */
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->deadline;
    }

    /**
     * @param integer $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    /**
     * @return StatusEntity
     */
    public function getStatus(): StatusEntity
    {
        return $this->status;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param string $format
     * @return string
     */
    public function createdAtToString(string $format = 'd.m.Y'): string
    {
        if ($this->createdAt instanceof DateTime) {
            return $this->createdAt->format($format);
        }
        return '';
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return "";
    }
}
