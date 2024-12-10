<?php
session_start();  // Iniciar sesión

// Recuperar los datos de la sesión
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
$monto = isset($_SESSION['monto']) ? $_SESSION['monto'] : 0;
$porcentajeInteres = isset($_SESSION['porcentajeInteres']) ? $_SESSION['porcentajeInteres'] : 0;
$resultados = isset($_SESSION['resultados']) ? $_SESSION['resultados'] : [];
$total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calculadoraGanancia.css">
    <title>Resultados - Calculadora de Ganancia</title>
</head>
<body>
    <div id="resultados">
        <div class="leyenda">
            <p>Señor/a <?php echo htmlspecialchars($nombre); ?>, ingresando $<?php echo number_format($monto, 2); ?> iniciales, 
            a una tasa del <?php echo $porcentajeInteres; ?>%, su ganancia anual será de:</p>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Ganancia Acumulada ($)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar cada mes y su ganancia acumulada
                foreach ($resultados as $row) {
                    echo "<tr><td>Mes {$row['mes']}</td><td>$" . number_format($row['ganancia'], 2) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <div class="total">
            <p><strong>Total de ganancia anual: $<?php echo number_format($total, 2); ?></strong></p>
        </div>
        
        <a href="index.html" class="volver">Volver al formulario</a>
    </div>
</body>
</html>
