<?php

declare(strict_types=1);

use App\Entity\StatusEntity;
use App\Entity\TaskEntity;
use App\Repository\StatusRepository;
use App\Services\StatusService;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class TaskEntityTest extends TestCase
{
    private int $statusId;

    protected function setUp(): void
    {
        $this->statusId = 1;
    }

    public function testAddTaskEntity(): void
    {
        $this->statusId = 1;

        $statusEntity = new StatusEntity(
            $this->statusId,
            'test',
            'тест'
        );

        $statusRepositorMock = $this->createMock(StatusRepository::class);

        $statusService = new StatusService($statusRepositorMock);
        $statusRepositorMock->expects(self::once())->method('findStatusByCode')->with('new')->willReturn($statusEntity);

        $statusEntityNew = $statusService->getStatusNew();

        $name = "Выжитить в 2026";
        $desc = "Желательно чтобы были деньги";
        $data = "31.12.2026";

        $taskEntity = TaskEntity::createNew(
            name: $name,
            description: $desc,
            deadline: $data,
            statusId: $this->statusId,
        );

        self::assertNotEmpty($taskEntity);
        self::assertNotEmpty($taskEntity->getName());

        self::assertInstanceOf(TaskEntity::class, $taskEntity);
        // self::assertInstanceOf(StatusEntity::class, $taskEntity->getStatus());

        self::assertEquals($name, $taskEntity->getName());
        self::assertEquals($desc, $taskEntity->getDescription());
        self::assertEquals($data, $taskEntity->getDate());
    }

    public function testThrowsExceptionWhenEmptyParams(): void
    {
        $name = "Выжитить в 2026";
        $desc = "";
        $data = "31.12.2026";

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('One of the parameters is empty');

        $statusEntityMock = $this->createMock(StatusEntity::class);

        $taskEntity = TaskEntity::createNew(
            name: $name,
            description: $desc,
            deadline: $data,
            statusId: $this->statusId,
        );
    }
}
