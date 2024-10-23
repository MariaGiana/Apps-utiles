<?php
require_once './models/photo.model.php';
require_once './views/json.view.php';

class PhotoApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PhotoModel();
        $this->view = new JSONView();
    }

    // /api/photos
    public function getAll($req, $res) {

        $orderBy = false;
        $filtro_name=null;
        // obtengo las tareas de la DB
        if(isset($req->query->name)) {
            $filtro_name = $req->query->name;
        }
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $photos = $this->model->getPhotos($orderBy,$filtro_name);
        
        // mando las photos a la vista
        return $this->view->response($photos);
    }

    // /api/photos/:id
    public function get($req, $res) {
        // obtengo el id de la photo desde la ruta
        $id = $req->params->id;

        // obtengo la photo de la DB
        $photo = $this->model->getPhoto($id);

        if(!$photo) {
            return $this->view->response("La foto con el id=$id no existe", 404);
        }

        // mando la photo a la vista
        return $this->view->response($photo);
    }

    //DELETE
    public function deletePhoto($req,$res){
        $id=$req->params->id;
        $photo=$this->model->getPhoto($id);
        if(!$photo){
            return $this->view->response("La photo con el id=$id no existe", 404);
        }
        $this->model->erasePhoto($id);
        $this->view->response("Photo con el id=$id, eliminada con exito");
        
    }
    //PUT
    public function updatePhoto($req,$res){
        $id=$req->params->id;
        $photo=$this->model->getPhoto($id);
        if(!$photo){
            return $this->view->response("La photo con el id=$id no existe", 404);
        }
       
        $name=$req->body['name'];
        $image=$req->body['image'];
        var_dump($name);
        var_dump($image);
        
    
        if(empty($name)|| empty($image)){
            return $this->view->response("Faltan completar campos obligatorios", 400);
        }

        $this->model->updatePhoto($id, $name, $image);
        $photo=$this->model->getPhoto($id);
       return $this->view->response($photo,200);
}

    //POST
    public function addPhoto($req,$res){
        $name=$req->body['name'];
        $image=$req->body['image'];
        

      // valído
    if (empty($name) || empty($image)) {
        return $this->view->response("Faltan completar campos obligatorios", 400);
    }

    // inserto la tarea
    $id = $this->model->insertPhoto($name, $image);
    if (!$id) {
        return $this->view->response("Error al insertar photo", 500);
    }

    // obtengo la tarea creada y la devuelvo
    $this->view->response("Photo creada con exito, id=$id");
    $photo = $this->model->getPhoto($id);
    return $this->view->response($photo, 201);


    }
}

