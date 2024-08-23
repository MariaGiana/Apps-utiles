<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Multiplicar</title>
    <link rel="stylesheet" href="tablaMultiplicar.css"> <!-- Vincula la hoja de estilo -->
</head>

<body>


    <?php


    if (isset($_POST['numeroMultiplicar']) && $_POST['numeroMultiplicar'] !== '') {
        $numeroMultiplicar = $_POST['numeroMultiplicar'];

        echo("<h1>TABLA DE MULTIPLICAR del: ".$numeroMultiplicar."</h1>");
        echo "<table  border='1' cellpadding='10' cellspacing='0'>";

        //fila del encabezado:
        echo "<tr><th></th>"; // Celda vacía en la esquina superior izquierda
        for ($y = 1; $y <= $numeroMultiplicar; $y++) {
            echo "<th class='amarillo'>" . $y . "</th>"; // Encabezado de columna para cada "y"
        }
        echo "</tr>";
        for ($x = 1; $x <= $numeroMultiplicar; $x++) {
            echo "<tr>"; // Debes abrir una nueva fila <tr> en cada iteración del bucle exterior
            echo "<td class='amarillo'>" . $x . "</td>";

            for ($y = 1; $y <= $numeroMultiplicar; $y++) {
                $resultado1 = $y * $x;
                if($x==$y){
                echo "<td class='amarillo'>" . $resultado1 . "</td>";
            }
            else echo "<td>" . $resultado1 . "</td>";
           
                }
        }
        echo '</tr>'; // Cerrar la fila después de completar la fila con los resultados
        echo ('</table>');
    } else {
        echo "<p style='color:red;'>Por favor, ingrese un valor válido para generar la tabla de multiplicar.</p>";
    }
    ?>
    <a href="index.html">VOLVER</a>
</body>

</html>