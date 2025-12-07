<?php

use App\DTO\TaskDTO;
use App\Entity\StatusEntity;
use App\Entity\TaskEntity;
use App\Repository\TaskRepository;
use App\Services\StatusService;
use App\Services\TaskServices;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TaskServiceTest extends TestCase
{
    private TaskDTO $dto;
    private MockObject $taskRepositoryMock;
    private MockObject $statusServiceMock;
    private TaskEntity $taskEntity;
    private StatusEntity $statusEntity;

    private string $taskName = 'Название новой задачи';
    private string $taskDesk = 'Описание новой задачи';

    protected function setUp(): void
    {
        $this->dto = new TaskDTO(
            name: $this->taskName,
            description: $this->taskDesk,
            date: '2025-12-12'
        );

        $this->statusEntity = new StatusEntity(100, 'new', 'Новый');

        $this->taskEntity = TaskEntity::createNew(
            name: $this->dto->name,
            description: $this->dto->description,
            date: $this->dto->date,
            status: $this->statusEntity
        );

        // 1. ARRANGE (ПОДГОТОВКА)
        // Создаем МОК (заглушку) для репозитория.
        // Она будет имитировать реальный репозиторий.
        $this->taskRepositoryMock = $this->createMock(TaskRepository::class);
        $this->statusServiceMock = $this->createMock(StatusService::class);
    }

    public function testAddTaskService()
    {
        // Настраиваем заглушку.
        // Мы ожидаем, что метод save будет вызван ровно 1 раз.
        $this->taskRepositoryMock->expects($this->once())->method('save')->willReturn($this->taskEntity); // Можно заставить метод возвращать определенное значение
        $this->statusServiceMock->expects($this->once())->method('getStatusNew')->willReturn($this->statusEntity);

        // Создаем экземпляр тестируемого сервиса, передавая ему заглушку
        $taskService = new TaskServices(
            $this->taskRepositoryMock,
            $this->statusServiceMock
        );

        // 2. ACT (ДЕЙСТВИЕ)
        // Вызываем метод, который хотим протестировать
        $taskEntity = $taskService->create($this->dto);

        // 3. ASSERT (ПРОВЕРКА)
        // Проверяем, что метод вернул то, что ожидалось
        // Например, что он вернул объект
        $this->assertInstanceOf(TaskEntity::class, $taskEntity);
        $this->assertInstanceOf(StatusEntity::class, $taskEntity->status);

        $this->assertEquals($taskEntity->getName(), $this->taskName);
        $this->assertEquals($taskEntity->getDescription(), $this->taskDesk);
    }
}