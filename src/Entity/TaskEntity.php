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
        public readonly string $date,
        public readonly StatusEntity $status,
        public readonly DateTime $createdAt,
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

    /**
     * @return string
     */
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
        return $this->date;
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
