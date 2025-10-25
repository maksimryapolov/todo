<?php

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

    public function __construct(
        readonly string $name,
        readonly string $description,
        readonly string $date,
        readonly string $status
    )
    {}
}
