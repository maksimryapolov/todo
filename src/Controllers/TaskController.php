<?php
namespace App\Controllers;

use DateTime;
use Exception;
use App\DTO\TaskDTO;
use App\Entity\StatusEntity;
use App\Services\StatusService;
use App\Services\TaskServices;
use App\Validators\ValidateTask;

class TaskController
{
    /**
     * @var ValidateTask
     */
    private ValidateTask $validator;

    /**
     * @var TaskServices
     */
    private TaskServices $taskServices;

    /**
     * @var StatusService
     */
    private StatusService $statusService;

    public function __construct(
        TaskServices $taskServices,
        ValidateTask $validator
        // StatusEntity $statusEntity
        //? Add other dependencies here if needed.
    ) {
        $this->validator = $validator;
        $this->taskServices = $taskServices;
    }

    public function add(array $params)
    {
        try {
            $this->validator->validate($params);

            $date = new DateTime($params['date']);

            $taskDTO = new TaskDTO(
                name: $params['name'],
                description: $params['description'],
                date: $date->format('d.m.Y'),
                status: 'new'
                // $this->statusService->getStatusByCode('new')
                // StatusEntity::getStatusNew()
            );

            $id = $this->taskServices->create($taskDTO);

        } catch (Exception $e) {}
    }
}
