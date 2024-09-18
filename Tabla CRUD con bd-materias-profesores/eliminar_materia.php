<?php
// Conectar a la base de datos
$db = new PDO('mysql:host=localhost;dbname=web_universitario;charset=utf8', 'root', '');

// Obtener el ID de la materia
$id = $_GET['id'];

// Preparar la consulta para eliminar la materia
$query = $db->prepare("DELETE FROM materia WHERE id = ?");
// Ejecutar la consulta
$result=$query->execute([$id]);

// Redirigimos al usuario de nuevo a la lista de materias
header('Location: index.php');
