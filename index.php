<?php
require_once "vendor\autoload.php";

use App\Services\TaskServices;
use App\Validators\ValidateTask;
use App\Repository\TaskRepository;
use App\Controllers\TaskController;
use App\DB\DataBaseConnectios;

$action = $_POST['action'] ?? '';

$dbConnection = DataBaseConnectios::getInstance();
echo'<pre>';var_dump($dbConnection->getConnection());echo'</pre>';
die;

switch($action) {
    case 'add':
        $taskepository = new TaskRepository();
        $taskServices = new TaskServices($taskepository);
        $validator = new ValidateTask();

        $taskController = new TaskController(
            validator: $validator,
            taskServices: $taskServices
        );
        $taskController->add($_POST);
        break;
}
