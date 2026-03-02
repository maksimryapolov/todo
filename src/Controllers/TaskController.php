<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\interfaces\ControllerInterface;
use App\DTO\TaskDTO;
use App\Services\TaskServices;
use App\Validators\ValidateContext;
use App\Views\TaskView;
use DateTime;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TaskController // implements ControllerInterface
{
    /**
     */
    public function __construct(
        private ValidateContext $validator,
        private TaskServices $taskServices
        //? Add other dependencies here if needed.
    ) {
    }

    public function add(Request $request, Response $response): Response // : TaskEntity // Контроллер должен отдавать Respone PSR-7
    {
        try {
            // new ResponseFactory
            $params = $request->getParsedBody();
            $this->validator->validate($params);

            if (!empty($this->validator->getErrors())) {
                throw new Exception(implode(', ', $this->validator->getErrors()), 403);
            }

            $date = new DateTime($params['date']);

            $taskDTO = new TaskDTO(
                name: $params['name'],
                description: $params['description'],
                deadline: $date->format('Y-m-d H:i:s'),
                // status: 'new'
            );

            $taskEntity = $this->taskServices->create($taskDTO);
            $view = new TaskView();

            $data = $view->getListData($taskEntity);
            echo'<pre>';var_dump($taskEntity);echo'</pre>';
            die;
            $result = [
                'data' => $data,
                'error' => []
            ];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json'); // ->withHeaders()->withStatus();
        } catch (\Throwable $e) {
            $result = [
                'data' => [],
                'error' => [
                    'code' => '',
                    'message' => $e->getMessage()
                ]
            ];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function get(Request $request, Response $response): Response
    {
        try {
            $data = [];

            $tasksEntities = $this->taskServices->getList(
                limit: 10,
                offset: 0,
                sort: 'created_ad',
                sortBy: 'DESC'
            );

            $view = new TaskView();
            // $data = $view->getListData($tasksEntities);

            $result = [
                'data' => $data,
                'error' => []
            ];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json'); // ->withHeaders()->withStatus();
        } catch (\Throwable $e) {
            $result = [
                'data' => [],
                'error' => [
                    'code' => '',
                    'message' => $e->getMessage()
                ]
            ];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json');
        }
    }
}
