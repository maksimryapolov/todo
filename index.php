<?php
require_once "./vendor/autoload.php";

use App\App\Container;
use App\Controllers\TaskController;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Response;

$request = ServerRequestFactory::createFromGlobals();

$action = $_POST['action'] ?? '';

$response = new Response();

// sendResponse($response);
/*
    Подсказка
    ENTITY = КИРПИЧ
    REPOSITORY = СКЛАД КИРПИЧЕЙ
    SERVICE = СТРОИТЕЛЬ
*/

switch($action) {
    case 'add':
        $container = new Container();
        sendResponse($container->get(TaskController::class)->add($request, $response));
        break;
}

function sendResponse($response) {
    // Статус
    header(sprintf(
        'HTTP/%s %s %s',
        $response->getProtocolVersion(),
        $response->getStatusCode(),
        $response->getReasonPhrase()
    ));

    // Заголовки
    foreach ($response->getHeaders() as $name => $values) {
        header($name . ': ' . implode(', ', $values));
    }

    // Тело
    echo $response->getBody();
}