<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre=isset($_POST['nombre'])? trim($_POST['nombre']) : '';// Obtener valor del nombre
        $monto=isset($_POST['monto'])? floatval($_POST['monto']) : 0;// Obtener valor del monto y convertirlo a float
        $porcentajeInteres=isset($_POST['porcentaje'])? floatval($_POST['porcentaje']):0;
        $ganancia=$monto;
        $total=0;

        if (!empty($nombre) && $monto > 0) {
        echo ("<div class='leyenda'> Señor/a ".$nombre.". Ingresando $".$monto." iniciales, a una tasa del ".$porcentajeInteres." %, su ganancia anual será de: </div>");
        echo "<table  border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr><th>Mes</th><th> Ganancia Acumulada ($)</th></tr>";
        for($mes=1;$mes<=12;$mes++){
            $ganancia += $monto * ($porcentajeInteres / 100);
        
        echo ("<tr><td>En el ".$mes."er mes, usted recibirá: </td> <td> $ ".$ganancia."</td></tr>");
        }
        $total+=$ganancia-$monto;
        
        echo "</table>";

        echo ("TOTAL DE GANACIA ANUAL: $".$total);
        echo(" ");
      
    }else {
        echo "<p style='color: red;'>Por favor, ingrese un nombre válido y un monto mayor a 0.</p>";
    }
}
        ?>
<a href="index.html">VOLVER</a>