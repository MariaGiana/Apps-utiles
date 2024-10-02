<?php

class TaskModel{
    private $db;
    // 1. Abro la conexión
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tareas;charset=utf8', 'root', '');
    }

    public function getTasks(){
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM tareas ORDER BY  prioridad ASC');
        $query->execute();
        // 3. Obtengo los datos en un arreglo de objetos
        $tasks = $query->fetchAll(PDO::FETCH_OBJ);
        return $tasks;
    }


    public function getTask($id){
        $query = $this->db->prepare('SELECT * FROM tareas WHERE id = ?');
        $query->execute([$id]);

        $task = $query->fetch(PDO::FETCH_OBJ);
        return $task;
    }

    public function insertTask($title, $description, $priority, $finished = false)
    {
        $query = $this->db->prepare('INSERT INTO tareas(titulo, descripcion, prioridad, finalizada) VALUES (?, ?, ?, ?)');
        $query->execute([$title, $description, $priority, $finished]);
        $id = $this->db->lastInsertId();

        return $id;
    }

    public function eraseTask($id)
    {
        $query = $this->db->prepare('DELETE FROM tareas WHERE id = ?');
        $query->execute([$id]);
    }


    function updateTask($id)
    {
        $query = $this->db->prepare('UPDATE tareas SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }


        public function modifyTask($id, $title, $description, $priority, $finished) {
            // Preparamos la consulta de actualización
            $query = $this->db->prepare('UPDATE tareas SET titulo = ?, prioridad = ?, descripcion = ?, finalizada = ? WHERE id = ?');
            
            $query->execute([$title, $priority, $description, $finished, $id]);
                    return true; 
        
    }
}
