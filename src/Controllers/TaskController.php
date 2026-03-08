<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTO\TaskDTO;
use App\Services\TaskServices;
use App\Validators\ValidateContext;
use App\Views\TaskView;
use DateTime;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TaskController extends BaseController // implements ControllerInterface
{
    /**
     * @param ValidateContext $validator
     * @param TaskServices $taskServices
     */
    public function __construct(
        private ValidateContext $validator,
        private TaskServices $taskServices
        //? Add other dependencies here if needed.
    ) {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function add(Request $request, Response $response): Response
    {
        try {
            // new ResponseFactory
            $params = $request->getParsedBody();
            $this->validator->validate($params);

            if (!empty($this->validator->getErrors())) {
                throw new Exception(implode(', ', $this->validator->getErrors()), 403);
            }

            $taskDTO = new TaskDTO(
                name: $params['name'],
                description: $params['description'],
                deadline: (new DateTime($params['date']))->format('Y-m-d H:i:s'),
                // status: 'new'
            );
            $taskEntity = $this->taskServices->create($taskDTO);

            return $this->createResponse($response, data: $this->taskServices->getViewItemData($taskEntity) ?? []);
        } catch (\Throwable $e) {
            return $this->createResponse($response, data: null, error: $e);
        }
    }

    public function get(Request $request, Response $response): Response
    {
        try {
            $tasksEntities = $this->taskServices->getList(
                limit: 10,
                offset: 0,
                sort: 'created_at',
                sortBy: 'DESC'
            );

            return $this->createResponse($response, data: $this->taskServices->getViewListData($tasksEntities) ?? []);
        } catch (\Throwable $e) {
            return $this->createResponse($response, data: null, error: $e);
        }
    }
}
