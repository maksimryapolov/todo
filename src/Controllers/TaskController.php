<?php
namespace App\Controllers;

use DateTime;
use Exception;
use App\DTO\TaskDTO;
use App\Entity\StatusEntity;
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

    public function __construct(
        TaskServices $taskServices,
        ValidateTask $validator
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
                status: StatusEntity::getStatusNew()
            );

            $id = $this->taskServices->create($taskDTO);

            echo'<pre>';var_dump($taskDTO);echo'</pre>';

        } catch (Exception $e) {}
    }
}
