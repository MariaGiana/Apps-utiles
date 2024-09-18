<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Lista de pagos</title>
</head>
<body>


<div class="container mb-5">
<h1>INGRESE PAGOS REALIZADOS</h1>
<form class="form-horizontal" action="agregar_pago.php" method="POST" name="form">

<div class="form-group">
  <label class="control-label col-sm-2">Nombre del deudor:  </label>
  <div class="col-sm-10">
  <input type="text" class="form-control" name="deudor" required>
</div>
    </div>
    <div class="form-group">
  <label class="control-label col-sm-2">Numero de cuota:  </label>
  <div class="col-sm-10">
  <input type="number"class="form-control" name="cuota" >
  </div>
    </div>
    <div class="form-group">
  <label class="control-label col-sm-2">Valor de la cuota:  </label>
  <div class="col-sm-10">
  <input type="number" step="any" class="form-control" name="cuota_capital" required>
  </div>
    </div>
    <div class="form-group">
  <label class="control-label col-sm-2">Fecha de cobro:  </label>
  <div class="col-sm-10">
  <input type="date" class="form-control"name="fecha_cobro" required>
  </div>
    </div>
    <button type="submit" class="btn btn-info mt-2" >ENVIAR</button>
    </form>


<?php

$db= new PDO('mysql:host=localhost;'. 'dbname=web2; charset-utf8','root', '');
//db es un objeto por eso llmamos a un metodo
$query=$db->prepare("select * from pagos");
//ejecutamos la consulta
$result=$query->execute();//si fuera un insert aca le pasamos un arreglo con: execute(["nombre","edad"...])
  //retornamos los resultados
$deudores= $query->fetchAll(PDO::FETCH_OBJ);
//Iteramos sobre los deudores de la tabla

//para que la tabla quede formato tabla 1ro ponemos el encabezado y luego iteramos
echo '<div class="container" >
<table class="table table-striped mt-5">
<tr>
    <th>ID</th>
    <th>Deudor</th>
    <th>Cuota</th>
    <th>Cuota Capital</th>
    <th>Fecha de Cobro</th>
      <th>Editar</th>
</tr>';
foreach($deudores as $deudor){
//echo "Id:".$deudor->id. ". Nombre: ". $deudor->deudor . ". Cuota: ". $deudor->cuota . ". Monto de la Cuota: ". $deudor->cuota_capital . ". Fecha de cobro: ". $deudor->fecha_cobro; 

echo "<tr>
    <td>" . $deudor->id . "</td>
    <td>" . $deudor->deudor . "</td>
    <td>" . $deudor->cuota . "</td>
    <td>" . $deudor->cuota_capital . "</td>
    <td>" . $deudor->fecha_cobro . "</td>
    <td><a href='modificar_pago.php.?id=".$deudor->id."' class='btn btn-info'> Modificar </a></td>
</tr>";
}
echo "</table>";

?>
</body>
</html>

    