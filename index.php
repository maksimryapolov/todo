<?php
require_once "./vendor/autoload.php";

use App\App\Container;
use App\Controllers\TaskController;

$action = $_POST['action'] ?? '';

// $dbConnection = DataBaseConnectios::getInstance();
// echo'<pre>';var_dump($dbConnection->getConnection());echo'</pre>';
// die;

switch($action) {
    case 'add':
        $container = new Container();
        $container->get(TaskController::class)->add($_POST);
        break;
}
