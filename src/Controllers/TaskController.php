<?php
namespace App\Controllers;

use DateTime;
use Exception;
use App\DTO\TaskDTO;
use App\Entity\TaskEntity;
use App\Services\TaskServices;
use App\Validators\ValidateContext;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Factory\ResponseFactory;

class TaskController
{
    /**
     * @param TaskServices $taskServices
     * @param ValidateContext $validator
     */
    public function __construct(
        private ValidateContext $validator,
        private TaskServices $taskServices
        //? Add other dependencies here if needed.
    ) {}

    public function add(Request $request, ResponseInterface $response)// : ResponseInterface // : TaskEntity // Контроллер должен отдавать Respone PSR-7
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
                date: $date->format('Y-m-d H:i:s'),
                // status: 'new'
            );

            $data = $this->taskServices->create($taskDTO);
            echo'<pre>';var_dump($data);echo'</pre>';
            die;
            $response->getBody()->write(json_encode($data));
            $response = $response->withHeader('Content-Type', 'application/json'); // ->withHeaders()->withStatus();
            return $response;
        } catch (Exception $e) {
            echo'<pre>';print($e->getMessage());echo'</pre>';
        }
    }
}
