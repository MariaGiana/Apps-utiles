<?php
require_once './app/models/task.model.php';
require_once './app/views/task.view.php';

Class TaskController{
    private $view;
    private $model;

    public function __construct($res){
        $this->view=new TaskView($res->user);
        $this->model=new TaskModel();
    }

   public function showTasks() {
        // obtengo las tareas de la DB
        $tasks =$this->model->getTasks();   
        //y ahora las tengo que mandar a la vista:
        $this->view->showTasks($tasks);
    }

   public function addTask() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            $error="Error: falta completar el titulo";
            $redir="nueva";
            return $this->view->showError($error,$redir);
        }
    
        if (!isset($_POST['priority']) || empty($_POST['priority'])) {
            $error = "Error: falta completar la prioridad";
            $redir="nueva";
            return $this->view->showError($error,$redir);
        }
        if (!isset($_POST['description']) || empty($_POST['description'])) {
            $error = "Error: falta completar la descripción";
            $redir = "nueva";
            return $this->view->showError($error, $redir);
        }
    
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
    
        $id = $this->model->insertTask($title, $description, $priority);
    
        // redirijo al home
        header('Location: ' . BASE_URL);
        exit; // Asegúrate de detener la ejecución después de redirigir
    } else {
        // Si no se ha enviado el formulario, muestra el formulario para agregar una tarea
        $this->view->showAddTaskForm(); // Asegúrate de tener este método en la vista
    }
}
    
   public function deleteTask($id) {
        // obtengo la tarea por id
        $task = $this->model->getTask($id);
    
        if (!$task) {
            $error= "No existe la tarea con el id=$id";
            $redir="listar";
            return $this->view->showError($error,$redir);
        }
    
        // borro la tarea y redirijo
        $this->model->eraseTask($id);
        header('Location: ' . BASE_URL);
    }
    
    
   public function finishTask($id) {
        $task = $this->model->getTask($id);
    
        if (!$task) {
            $error="No existe la tarea con el id=$id";
            $redir="listar";
            return $this->view->showError($error,$redir);
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
            if (!isset($_POST['title']) || empty($_POST['title'])) {
                $error="Error: falta completar el titulo";
                $redir="listar";
                return $this->view->showError($error,$redir);
            }
        
            if (!isset($_POST['priority']) || empty($_POST['priority'])) {
                $error = "Error: falta completar la prioridad";
                $redir="listar";
                return $this->view->showError($error,$redir);
            }
            if (!isset($_POST['description']) || empty($_POST['description'])) {
                $error = "Error: falta completar la descripción";
                $redir = "listar";
                return $this->view->showError($error, $redir);
            }
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
        $redir="listar";
        $this->view->showError($error,$redir);

    }
}

