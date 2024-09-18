<?php
//1ro hago la conexion a la base de datos:
$db= new PDO('mysql:host=localhost;'. 'dbname=web_universitario; charset-utf8','root', '');

// Recibimos los datos del formulario:
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $profesor=$_POST['profesor'];

    // Preparar la consulta para actualizar la materia
    $query=$db->prepare("UPDATE materia SET nombre = ?, profesor = ? WHERE id = ?");

    //ejecutamos la consulta
    $result=$query->execute([$nombre,$profesor,$id]);
    // Redirigimos al usuario de nuevo a la lista de materias
    header('Location: index.php');