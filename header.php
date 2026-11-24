<?php
$pagina = $pagina ?? "inicio";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HogarFin - Gestión familiar</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <div class="contenedor">

        <header class="barra-superior">
            <div class="marca">
                <h2>🏠 HogarFin</h2>
                <p>Gestión familiar</p>
                <p>Usuario: <?php echo htmlspecialchars($_SESSION["nombre"]); ?></p>
                <p>Familia: <?php echo htmlspecialchars($_SESSION["nombre_familia"]); ?></p>
            </div>

            <nav class="navegacion" aria-label="Navegación principal">
                <a href="index.php" class="<?php echo $pagina === 'inicio' ? 'activo' : ''; ?>">Inicio</a>
                <a href="presupuestos.php" class="<?php echo $pagina === 'presupuestos' ? 'activo' : ''; ?>">Presupuestos</a>
                <a href="ingresos_gastos.php" class="<?php echo $pagina === 'movimientos' ? 'activo' : ''; ?>">Ingresos y gastos</a>
                <a href="vivienda.php" class="<?php echo $pagina === 'vivienda' ? 'activo' : ''; ?>">Vivienda</a>
                <a href="inventario.php" class="<?php echo $pagina === 'inventario' ? 'activo' : ''; ?>">Inventario</a>
                <a href="reservas.php" class="<?php echo $pagina === 'reservas' ? 'activo' : ''; ?>">Reservas</a>
                <a href="avisos.php" class="<?php echo $pagina === 'avisos' ? 'activo' : ''; ?>">Previsión y avisos</a>
                <a href="familia.php" class="<?php echo $pagina === 'familia' ? 'activo' : ''; ?>">Familia</a>
                <a href="login.php" class="enlace-salir">Salir</a>
            </nav>
        </header>

        <main class="contenido">
            <header class="cabecera">
                <h1>Planificación económica familiar</h1>
                <p>Control de la economía del hogar</p>
            </header>
