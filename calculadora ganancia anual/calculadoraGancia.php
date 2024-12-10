<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $monto = isset($_POST['monto']) ? floatval($_POST['monto']) : 0;
    $porcentajeInteres = isset($_POST['porcentaje']) ? floatval($_POST['porcentaje']) : 0;
    $ganancia = $monto;
    $total = 0;
    $resultados = [];

    if (!empty($nombre) && $monto > 0) {
        for ($mes = 1; $mes <= 12; $mes++) {
            $ganancia += $monto * ($porcentajeInteres / 100);
            $resultados[] = ['mes' => $mes, 'ganancia' => $ganancia];
        }
        $total += $ganancia - $monto;

        // Guardamos los datos en la sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['monto'] = $monto;
        $_SESSION['porcentajeInteres'] = $porcentajeInteres;
        $_SESSION['resultados'] = $resultados;
        $_SESSION['total'] = $total;

        // Redirigir a resultados.php
        header('Location: resultados.php');
        exit;
    } else {
        echo "<p style='color: red;'>Por favor, ingrese un nombre válido y un monto mayor a 0.</p>";
    }
}
?>
<a href="index.html">VOLVER</a>
