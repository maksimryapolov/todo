<?php

declare(strict_types=1);

namespace App\Entity;

class StatusEntity implements IEntity
{
    /**
     * @param integer $id
     * @param string $code
     * @param string $name
     */
    public function __construct(
        private int $id,
        private string $code,
        private string $name
    ) {
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
