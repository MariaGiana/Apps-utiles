<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>WEB UNIVERSITARIO</title>
</head>
<body>
<?php
    $db= new PDO('mysql:host=localhost;'. 'dbname=web_universitario; charset-utf8','root', '');
//db es un objeto por eso llmamos a un metodo
$query=$db->prepare("select * from materia");
//ejecutamos la consulta
$result=$query->execute();//si fuera un insert aca le pasamos un arreglo con: execute(["nombre","edad"...])
  //retornamos los resultados
$materias= $query->fetchAll(PDO::FETCH_OBJ);
?>
    <h1>Lista de Materias</h1>

<?php
echo ' <div class="container" >
<table class="table table-striped mt-5">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Profesor</th>
                <th COLSPAN=2>Editar</th>
                
            </tr>';
foreach($materias as $materia){
    
            echo'<tr> <td> '. $materia->id. '</td> <td> '. $materia->nombre. '</td><td>  ' . $materia->profesor . '</td> 
            <div class="btn-group">
            <td><a href="modificar_materia.php?id='. $materia->id .'" class="btn btn-info"> Modificar </a> </td>
            <td><a href="eliminar_materia.php?id='. $materia->id .'" class="btn btn-primary">Eliminar </a> </td></div></tr> ';
           
        }
         echo '</div> </table>';
       ?>
<a href="formularioAgregar.html" class="btn btn-primary active">AGREGAR NUEVO</a>

</body>
</html>