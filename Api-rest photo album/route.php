
<?php

require_once 'libs/router.php';
require_once 'controllers/photo.api.controller.php';

//echo "Router y controlador cargados.<br>"; // Mensaje de depuración

$router = new Router();

// Definir las rutas
$router->addRoute('photos'    , 'GET', 'PhotoApiController', 'getAll');
$router->addRoute('photos/:id', 'GET', 'PhotoApiController', 'get');
$router->addRoute('photos/:id', 'DELETE', 'PhotoApiController', 'deletePhoto');
$router->addRoute('photos/:id', 'PUT', 'PhotoApiController', 'updatePhoto');
$router->addRoute('photos'    , 'POST', 'PhotoApiController', 'addPhoto');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
