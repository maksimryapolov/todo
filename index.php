<?php
require_once "./vendor/autoload.php";

use App\App\Container;
use App\Controllers\TaskController;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Response;
use Dotenv\Dotenv;

$request = ServerRequestFactory::createFromGlobals();
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$parseBody = $request->getParsedBody();
$action = '';

if(isset($parseBody['action'])) {
    $action = trim($parseBody['action']);
}

$response = new Response();

// sendResponse($response);
/*
    Подсказка
    ENTITY = КИРПИЧ
    REPOSITORY = СКЛАД КИРПИЧЕЙ
    SERVICE = СТРОИТЕЛЬ
*/

$container = new Container();

switch($action) {
    case 'add':
        sendResponse($container->get(TaskController::class)->add($request, $response));
        break;
    default:
        sendResponse($container->get(TaskController::class)->get($request, $response));
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
