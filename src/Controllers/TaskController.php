<?php
namespace App\Controllers;

use DateTime;
use Exception;
use App\DTO\TaskDTO;
use App\Entity\TaskEntity;
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
     * @param TaskServices $taskServices
     * @param ValidateTask $validator
     */
    public function __construct(
        TaskServices $taskServices,
        ValidateTask $validator
        //? Add other dependencies here if needed.
    ) {
        $this->validator = $validator;
        $this->taskServices = $taskServices;
    }

    public function add(array $params): TaskEntity
    {
        try {
            $this->validator->validate($params);

            $date = new DateTime($params['date']);

            $taskDTO = new TaskDTO(
                name: $params['name'],
                description: $params['description'],
                date: $date->format('Y-m-d H:i:s'),
                // status: 'new'
            );

            return $this->taskServices->create($taskDTO);
        } catch (Exception $e) {}
    }
}
