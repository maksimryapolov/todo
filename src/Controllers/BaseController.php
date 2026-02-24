<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use \Exception;

class BaseController
{
    /**
     * @param Response $response
     * @param array $data
     * @param Exception|null $error
     * @return Response
     */
    public function createResponse(Response $response, ?array $data, ?Exception $error = null): Response
    {
        $response->getBody()->write(json_encode([
            'data' => $data,
            'errors' => ($error) ? [
                'code' => $error->getCode(),
                'message' => $error->getMessage()
            ] : null
        ]));

        $response = $response->withHeader('Content-Type', 'application/json');
        return $response;
    }
}