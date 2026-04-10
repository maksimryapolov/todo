<?php

declare(strict_types=1);

use App\DTO\TaskDTO;
use App\Entity\StatusEntity;
use App\Entity\TaskEntity;
use App\Repository\TaskRepository;
use App\Services\StatusService;
use App\Services\TaskServices;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class TaskServiceTest extends TestCase
{
    private TaskDTO $dto;
    private TaskRepository&MockObject $taskRepositoryMock;
    private StatusService&MockObject $statusServiceMock;
    private TaskEntity $taskEntity;
    private StatusEntity $statusEntity;
    private int $statusId;
    private string $taskName = 'Название новой задачи';
    private string $taskDesk = 'Описание новой задачи';

    protected function setUp(): void
    {
        $this->statusId = 1;

        $this->dto = new TaskDTO(
            name: $this->taskName,
            description: $this->taskDesk,
            deadline: '2025-12-12'
        );

        $this->statusEntity = new StatusEntity($this->statusId, 'new', 'Новый');

        $this->taskEntity = TaskEntity::createNew(
            name: $this->dto->name,
            description: $this->dto->description,
            deadline: $this->dto->deadline,
            statusId: $this->statusId
        );

        // 1. ARRANGE (ПОДГОТОВКА)
        // Создаем МОК (заглушку) для репозитория.
        // Она будет имитировать реальный репозиторий.
        $this->taskRepositoryMock = $this->createMock(TaskRepository::class);
        $this->statusServiceMock = $this->createMock(StatusService::class);
    }

    public function ignoreAddTaskService(): void
    {
        // Настраиваем заглушку.
        // Мы ожидаем, что метод save будет вызван ровно 1 раз.
        $this->taskRepositoryMock->expects(self::once())->method('save')->willReturn($this->taskEntity); // Можно заставить метод возвращать определенное значение
        $this->statusServiceMock->expects(self::once())->method('getStatusNew')->willReturn($this->statusEntity);

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
        self::assertInstanceOf(TaskEntity::class, $taskEntity);
        // self::assertInstanceOf(StatusEntity::class, $taskEntity->getStatus());

        self::assertEquals($taskEntity->getName(), $this->taskName);
        self::assertEquals($taskEntity->getDescription(), $this->taskDesk);
    }

    public function testGetListService(): void
    {
        $tasks = [$this->taskEntity];
        $statuses = [$this->statusId => $this->statusEntity];

        $taskService = new TaskServices(
            $this->taskRepositoryMock,
            $this->statusServiceMock
        );

        $this->taskRepositoryMock->expects(self::once())->method('getList')->willReturn($tasks);
        $this->statusServiceMock->expects(self::once())->method('getStatusByIds')->willReturn($statuses);

        $result = $taskService->getList();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);

        $resultTask = reset($result);

        $this->assertInstanceOf(TaskEntity::class, $resultTask);
        $this->assertInstanceOf(StatusEntity::class, $resultTask->getStatus());

        //  проверит, что вернулся тот самый объект, а не его копия с такими же данными.
        $this->assertSame($this->taskEntity, $resultTask);
        //

        $this->assertEquals($this->statusId, $resultTask->getStatus()->getId());
        $this->assertEquals($resultTask->getName(), $this->taskName);
    }

    public function testEmptyGetListService(): void
    {
        $tasks = [];
        $statuses = [];

        $taskService = new TaskServices(
            $this->taskRepositoryMock,
            $this->statusServiceMock
        );

        $this->taskRepositoryMock->expects(self::once())->method('getList')->willReturn($tasks);
        $this->statusServiceMock->expects(self::once())->method('getStatusByIds')->willReturn($statuses);

        $result = $taskService->getList();

        $this->assertIsArray($result, 'is not array');
        $this->assertCount(0, $result, 'is not empty');
    }
}
