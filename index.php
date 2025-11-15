<?php
require_once "./vendor/autoload.php";

use App\App\Container;
use App\Controllers\TaskController;

$action = $_POST['action'] ?? '';

/*
    Подсказка
    ENTITY = КИРПИЧ
    REPOSITORY = СКЛАД КИРПИЧЕЙ
    SERVICE = СТРОИТЕЛЬ
*/

switch($action) {
    case 'add':
        $container = new Container();
        $task = $container->get(TaskController::class)->add($_POST);
        // echo'<pre>';var_dump($task);echo'</pre>';
        break;
}
