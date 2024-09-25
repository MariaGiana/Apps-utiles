<?php
require_once 'task.model.php';
require_once 'task.view.php';

Class TaskController{
    private $view;
    private $model;

    public function __construct(){
        $this->view=new TaskView();
        $this->model=new TaskModel();
    }

   public function showTasks() {
        // obtengo las tareas de la DB
        $tasks =$this->model->getTasks();   
        //y ahora las tengo que mandar a la vista:
        $this->view->showTasks($tasks);
    }

   public function addTask() {

        if (!isset($_POST['title']) || empty($_POST['title'])) {
            $error="<h1>Error: falta completar el titulo</h1>";
            return $this->view->showError($error);
            
        }
    
        if (!isset($_POST['priority']) || empty($_POST['priority'])) {
            $error = "<h1>Error: falta completar la prioridad</h1>";
            return $this->view->showError($error);
        }
    
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
    
        $id = $this->model->insertTask($title, $description, $priority);
    
        // redirijo al home
        header('Location: ' . BASE_URL);
    }
    
   public function deleteTask($id) {
        // obtengo la tarea por id
        $task = $this->model->getTask($id);
    
        if (!$task) {
            $error= "<h1>No existe la tarea con el id=$id</h1>";
            return $this->view->showError($error);
        }
    
        // borro la tarea y redirijo
        $this->model->eraseTask($id);
        header('Location: ' . BASE_URL);
    }
    
    
   public function finishTask($id) {
        $task = $this->model->getTask($id);
    
        if (!$task) {
            $error="<h1>No existe la tarea con el id=$id</h1>";
            return $this->view->showError($error);
        }
    
        $this->model->updateTask($id);
        header('Location: ' . BASE_URL);
    }


//TRABAJANDO EN::::


    public function changeTask($id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      // obtengo las tareas de la DB
      $task =$this->model->getTask($id);   
      //y ahora las tengo que mandar a la vista:
      $this->view->showTask($task);

        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si se envió el formulario, procesamos la actualización
        // Capturamos los datos enviados desde el formulario
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $finished = isset($_POST['finished']) ? 1 : 0;  // Si se marca como finalizada

        // Actualizamos la tarea en la base de datos
        $this->model->modifyTask($id, $title, $description, $priority, $finished);
        header('Location: ' . BASE_URL);
    
        }

}

public function seeTask($id){
    // obtengo las tareas de la DB
    $task =$this->model->getTask($id);   
    $this->view->showDescription($task);
}

    public function showError(){
        $error="404 not found";
        $this->view->showError($error);

    }
}

