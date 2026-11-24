<?php
include "conexion.php";

$error = "";
$correcto = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $familia = $_POST["nombre_familia"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];

    if ($password != $password_confirm) {

        $error = "Las contraseñas no coinciden.";
    } elseif (strlen($password) < 8) {

        $error = "La contraseña debe tener al menos 8 caracteres.";
    } else {

        // Comprobar si el correo ya existe
        $consulta = mysqli_prepare($conexion, "SELECT id_usuario FROM usuarios WHERE email = ?");
        mysqli_stmt_bind_param($consulta, "s", $email);
        mysqli_stmt_execute($consulta);
        $resultado = mysqli_stmt_get_result($consulta);

        if (mysqli_num_rows($resultado) > 0) {

            $error = "Este correo ya está registrado.";
        } else {

            // Crear la familia
            $consulta = mysqli_prepare($conexion, "INSERT INTO familias (nombre) VALUES (?)");
            mysqli_stmt_bind_param($consulta, "s", $familia);
            mysqli_stmt_execute($consulta);

            $id_familia = mysqli_insert_id($conexion);

            // Crear el usuario
            $password_segura = password_hash($password, PASSWORD_DEFAULT);
            $rol = "administrador";

            $consulta = mysqli_prepare($conexion, "INSERT INTO usuarios (id_familia, nombre, email, password, rol) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($consulta, "issss", $id_familia, $nombre, $email, $password_segura, $rol);

            if (mysqli_stmt_execute($consulta)) {

                $correcto = "¡Familia y cuenta creadas correctamente!";
            } else {

                $error = "No se ha podido crear la cuenta.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HogarFin - Crear familia y cuenta</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body class="pantalla-auth">

    <main class="tarjeta-auth">
        <div class="marca-auth">
            <h2>🏠 HogarFin</h2>
            <p>Planificación económica familiar</p>
        </div>

        <h1>Crear cuenta familiar</h1>
        <p class="subtitulo-auth">El primer usuario será el administrador de la familia.</p>

        <?php if ($error != "") { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>

        <?php if ($correcto != "") { ?>

            <p><?php echo $correcto; ?></p>
            <a href="login.php" class="boton-principal">Iniciar sesión</a>

        <?php } else { ?>

            <form action="registro.php" method="post" class="formulario-auth">

                <div class="campo">
                    <label for="nombre_familia">Nombre de la familia</label>
                    <input type="text" id="nombre_familia" name="nombre_familia" class="campo-input" placeholder="Ej. Familia García" required>
                </div>

                <div class="campo">
                    <label for="nombre">Tu nombre</label>
                    <input type="text" id="nombre" name="nombre" class="campo-input" placeholder="Ej. Laura" required>
                </div>

                <div class="campo">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="campo-input" placeholder="laura@familia.com" required>
                </div>

                <div class="campo">
                    <label for="password">Contraseña (mínimo 8 caracteres)</label>
                    <input type="password" id="password" name="password" class="campo-input" minlength="8" required>
                </div>

                <div class="campo">
                    <label for="password_confirm">Confirmar contraseña</label>
                    <input type="password" id="password_confirm" name="password_confirm" class="campo-input" minlength="8" required>
                </div>

                <button type="submit" class="boton-principal boton-ancho">Registrar familia</button>

            </form>

            <p class="pie-auth">
                ¿Ya tienes cuenta? <a href="login.php" class="enlace">Iniciar sesión</a>
            </p>

        <?php } ?>

    </main>

</body>

</html>