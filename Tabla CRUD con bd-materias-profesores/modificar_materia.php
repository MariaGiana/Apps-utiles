<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<?php
// 1ro Conectar a la base de datos
$db = new PDO('mysql:host=localhost;dbname=web_universitario;charset=utf8', 'root', '');

// 2do Obtener el ID de la materia
$id = $_GET['id'];

// Obtener los datos de la materia actual
$query = $db->prepare("SELECT * FROM materia WHERE id = ?");
//ejecutamos la consulta
$query->execute([$id]);
 //retornamos los resultados:
$materia = $query->fetch(PDO::FETCH_OBJ);
?>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" action="actualizar_materia.php" method="post" name="form"> 
                    <fieldset>
                        <legend class="text-center header">Modificar Materia</legend>

                        <div class="form-group pb-2">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                            <input type="hidden" name="id" value="<?= $materia->id ?>">
                            <input id="fname" name="nombre" type="text" value="<?= $materia->nombre ?>" class="form-control" required>
              
                        </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="lname" name="profesor" type="text" value="<?= $materia->profesor ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group pt-3" >
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" >Actualizar Materia</button>
                                <a href="index.php" class="btn btn-primary btn-lg">VOLVER</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>