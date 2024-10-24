<?php
    
    require_once 'libs/router.php';

    require_once 'app/controllers/task.api.controller.php';

    $router = new Router();

    #                 endpoint        verbo     controller             metodo
    $router->addRoute('tareas'      , 'GET',    'TaskApiController',   'getAll');
    $router->addRoute('tareas/:id'  , 'GET',    'TaskApiController',   'get');
    $router->addRoute('tareas/:id'  , 'DELETE',  'TaskApiController', 'deleteTask');
    $router->addRoute('tareas'      , 'POST',    'TaskApiController', 'createTask'); 
    $router->addRoute('tareas/:id'  , 'PUT',    'TaskApiController', 'updateTask'); 
    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);