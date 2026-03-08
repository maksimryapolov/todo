<?php

declare(strict_types=1);

namespace App\DTO;

use DateTime;

/**
 * DTO - Data Transfer Object
 *
 * Курьер данных: только переносит информацию между слоями приложения
 * без изменения её содержимого.
 *
 * Ответственность: передача данных
 * Запрещено: бизнес-логика, валидация, преобразования
 *
 * 📦 Принимает данные → 🚶 Переносит → 📬 Отдает как есть
 */
class TaskDTO
{
    // readonly DateTime $dateTime;

    /**
     * @param string $name
     * @param string $description
     * @param string $date
     * @param string|null $status
     */
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $deadline,
        public readonly ?string $statusId = null
    ) {
    }
}
