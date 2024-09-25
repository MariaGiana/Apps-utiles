<?php
require_once './app/task.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'listar'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'listar':
        //ahora tengo que crear el controlador para que exista
        $controler=new TaskController();
        $controler->showTasks();
        break;
    case 'nueva':
        $controler=new TaskController();
        $controler->addTask();
        break;
    case 'eliminar':
        $controler=new TaskController();
        $controler->deleteTask($params[1]);
        break;
    case 'finalizar':
        $controler=new TaskController();
        $controler->finishTask($params[1]);
        break; 
     case 'modificar':
        $controler=new TaskController();
        $controler->changeTask($params[1]);
        break; 
        case 'verMas':
            $controler=new TaskController();
            $controler->seeTask($params[1]);
            break;
    default: 
    $controler=new TaskController();
    $controler->showError();
        break;
}