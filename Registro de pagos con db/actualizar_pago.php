<?php
//1ro establecemos conexion
$db= new PDO('mysql:host=localhost;'. 'dbname=web2; charset=utf8','root', '');
//2do tomamos los datos del formulario

$deudor=$_POST['deudor'];
$id=$_POST['id'];
$cuota=$_POST['cuota'];
$cuota_capital=$_POST['cuota_capital'];
$fecha_cobro=$_POST['fecha_cobro'];

//3ro preparamos la consulta
$query=$db->prepare("UPDATE pagos SET deudor = ?, cuota = ?, cuota_capital = ?, fecha_cobro = ? WHERE id = ?");

//4to ejecutamos la consulta
$query->execute([$deudor,$cuota,$cuota_capital,$fecha_cobro, $id]);
    // Redirigimos al usuario de nuevo a la lista de materias
    header('Location: index.php');
