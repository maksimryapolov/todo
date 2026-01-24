<?php

declare(strict_types=1);

namespace App\Entity;

interface IEntity
{
    public function getId(): ?int;
    public function getName(): string;
    public function getCode(): string;
}
