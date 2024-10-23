<?php

class PhotoModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_photoalbum;charset=utf8', 'root', '');
    }
 
    public function getPhotos($orderBy = false, $filtro_name= null) {
        $sql = 'SELECT * FROM objects';

        if ($filtro_name != null) {
            $sql .= ' WHERE name = :name';
    }
    if($orderBy) {
        switch($orderBy) {
            case 'nombre':
                $sql .= ' ORDER BY name';
                break;
            case 'id':
                $sql .= ' ORDER BY id';
                break;
        }
        }
        // 2. Ejecuto la consulta
        $query = $this->db->prepare($sql);


        //si no pongo esto me da error
        if ($filtro_name != null) {
            $query->bindParam(':name', $filtro_name, PDO::PARAM_STR);
        }

        
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $photos = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $photos;
    }
 
    public function getPhoto($id) {    
        $query = $this->db->prepare('SELECT * FROM objects WHERE id = ?');
        $query->execute([$id]);   
    
        $photo = $query->fetch(PDO::FETCH_OBJ);
    
        return $photo;
    }
 
    public function insertPhoto($name,$image) { 
        $query = $this->db->prepare('INSERT INTO objects(name,image) VALUES (?, ?)');
        $query->execute([$name,$image]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function erasePhoto($id) {
        $query = $this->db->prepare('DELETE FROM objects WHERE id = ?');
        $query->execute([$id]);
    }

    public function updatePhoto($id,$name,$image) {        
        $query = $this->db->prepare('UPDATE objects SET name = ?, image = ? WHERE id = ?');
        $query->execute([$name,$image,$id]);
        return true; 
    }
    
      
    
}