<?php
//1ro establecemos conexion
$db= new PDO('mysql:host=localhost;'. 'dbname=web2; charset=utf8','root', '');
//2do tomamos los valores del form
$deudor=$_GET['deudor']??null;
$cuota=$_GET['cuota']??null;
$cuota_capital=$_GET['cuota_capital']??null;
$fecha_cobro=$_GET['fecha_cobro']??null;

// Verificamos si los valores no son nulos
if ($deudor && $cuota && $cuota_capital && $fecha_cobro) {
//punto extra no quiero insertar repetido,entonces pregunto si para ese usuario existe la cuota, no ingresarlo
$query=$db->prepare("INSERT into pagos (deudor,cuota,cuota_capital,fecha_cobro) VALUES (?,?,?,?)");
$query1=$db->prepare("SELECT * from pagos WHERE deudor=? AND cuota=?");
//3ro preparamos la insercion con los valores ??
//4to ejecutamos la insercion

$result2=$query1->execute([$deudor,$cuota]);
$pago_existente= $query1->fetchAll(PDO::FETCH_ASSOC);
if($pago_existente){
    echo "Esta cuota ya se encuentra paga";
    ?><a href="lista-pagos.php">VOLVER</a><?php
}else {
    $result=$query->execute([$deudor,$cuota,$cuota_capital,$fecha_cobro]);
    header('Location: lista-pagos.php');
}
}
else {echo "Ingresar todos los valores";
    ?><a href="lista-pagos.php">VOLVER</a><?php
} 
