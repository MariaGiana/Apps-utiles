<?php
//1ro hago la conexion a la base de datos:
$db= new PDO('mysql:host=localhost;'. 'dbname=web_universitario; charset-utf8','root', '');

// Recibimos los datos del formulario:
    $nombre=$_POST['nombre'];
    $profesor=$_POST['profesor'];

    // Preparamos la consulta para insertar la nueva materia, por eso el parametro vacio
    $query=$db->prepare("INSERT INTO materia(nombre,profesor) VALUES (?,?)");

    //ejecutamos la insercion
    $result=$query->execute([$nombre,$profesor]);
    // Redirigimos al usuario de nuevo a la lista de materias
    header('Location: index.php');
