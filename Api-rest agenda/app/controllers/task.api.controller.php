<?php
require_once './app/models/task.model.php';
require_once './app/views/json.view.php';

class TaskApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new TaskModel();
        $this->view = new JSONView();
    }

    // /api/tareas
    //devuelve todas las tareas
    public function getAll($req, $res) {
       // Verifica si el parámetro "finalizada" está presente
    if (isset($req->query->finalizada)) {
        if ($req->query->finalizada == '1') {
            $filtrarFinalizadas = 'true';  
        } else if ($req->query->finalizada == '0') {
            $filtrarFinalizadas = 'false'; 
        }
    }
        //filtro ordenada por id
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $tasks = $this->model->getTasks($filtrarFinalizadas, $orderBy);
        
        // mando las tareas a la vista
        return $this->view->response($tasks);
    }

    // /api/tareas/:id
    //una tarea determinada
    public function get($req, $res) {
        // obtengo el id de la tarea desde la ruta
        $id = $req->params->id;

        // obtengo la tarea de la DB
        $task = $this->model->getTask($id);

        if(!$task) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }

        // mando la tarea a la vista
        return $this->view->response($task);
    }

    public function deleteTask($req,$res){
        $id=$req->params->id;
        $task=$this->model->getTask($id);
        if(!$task){
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }
        $this->model->eraseTask($id);
        $this->view->response("Tarea con el id=$id, eliminada con exito");
    }

    public function createTask($req, $res){
         
        $titulo=$req->body['titulo'];
        $descripcion=$req->body['descripcion'];
        $prioridad=$req->body['prioridad'];

      // valído
    if (empty($titulo) || empty($prioridad)) {
        return $this->view->response("Faltan completar campos obligatorios", 400);
    }

    // inserto la tarea
    $id = $this->model->insertTask($titulo, $descripcion, $prioridad);
    if (!$id) {
        return $this->view->response("Error al insertar tarea", 500);
    }

    // obtengo la tarea creada y la devuelvo
    $this->view->response("Tarea creada con exito, id=$id");
    $task = $this->model->getTask($id);
    return $this->view->response($task, 201);
}


    public function updateTask($req, $res){
        $id=$req->params->id;
        $task=$this->model->getTask($id);
        if(!$task){
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }
       
        $titulo=$req->body['titulo'];
        $descripcion=$req->body['descripcion'];
        $prioridad=$req->body['prioridad'];
        $finalizada=$req->body['finalizada'];
    
        if(empty($titulo)|| empty($prioridad) || empty($finalizada)){
            return $this->view->response("Faltan completar campos obligatorios", 400);
        }

        $this->model->modifyTask($id, $titulo, $descripcion, $prioridad, $finalizada);
        $task=$this->model->getTask($id);
       return $this->view->response($task,200);
}
}
