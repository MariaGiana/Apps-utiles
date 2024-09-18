<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modificar Pago</title>
</head>
<body>
    
<?php
//1ro establecemos conexion
$db= new PDO('mysql:host=localhost;'. 'dbname=web2; charset=utf8','root', '');
//2do tomo el id:
$id=$_GET['id'];
//3ro preparo la consulta
$query=$db->prepare("SELECT * FROM pagos WHERE id = ?");
//4to ejecuto la consulta
$query->execute([$id]);
//5to devuelvo el resultado
$pagos = $query->fetch(PDO::FETCH_OBJ);

?>


<div class="container mb-5">
<h1>EDITE PAGOS REALIZADOS</h1>
<form class="form-horizontal" action="actualizar_pago.php" method="POST" name="form">
<div class="form-group">
    
  <label class="control-label col-sm-2">Nombre del deudor:  </label>
  <div class="col-sm-10">
  <input type="text" class="form-control" name="deudor" value="<?= $pagos->deudor ?>" required>
  <input type="hidden" class="form-control" name="id" value="<?= $pagos->id ?>">
</div>
    </div>
    <div class="form-group">
  <label class="control-label col-sm-2">Numero de cuota:  </label>
  <div class="col-sm-10">
  <input type="number"class="form-control" name="cuota" value= "<?= $pagos->cuota ?>">
  </div>
    </div>
    <div class="form-group">
  <label class="control-label col-sm-2">Valor de la cuota:  </label>
  <div class="col-sm-10">
  <input type="number" step="any" class="form-control" name="cuota_capital" value="<?= $pagos->cuota_capital ?>" required>
  </div>
    </div>
    <div class="form-group">
  <label class="control-label col-sm-2">Fecha de cobro:  </label>
  <div class="col-sm-10">
  <input type="date" class="form-control"name="fecha_cobro" value="<?= $pagos->fecha_cobro ?>"required>
  </div>
    </div>
    <button type="submit" class="btn btn-info mt-2" >ENVIAR</button>
    </form>


</body>
</html>
