    
<?php
session_start();
include "conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $consulta = mysqli_prepare($conexion, "SELECT usuarios.id_usuario, usuarios.id_familia, usuarios.nombre, usuarios.password, usuarios.rol, familias.nombre AS nombre_familia FROM usuarios INNER JOIN familias ON usuarios.id_familia = familias.id_familia WHERE usuarios.email = ?");
    mysqli_stmt_bind_param($consulta, "s", $email);
    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);

    if (mysqli_num_rows($resultado) > 0) {

        $usuario = mysqli_fetch_assoc($resultado);

        if (password_verify($password, $usuario["password"])) {

            $_SESSION["id_usuario"] = $usuario["id_usuario"];
            $_SESSION["id_familia"] = $usuario["id_familia"];
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["nombre_familia"] = $usuario["nombre_familia"];
            $_SESSION["rol"] = $usuario["rol"];

            header("Location: index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "No existe ninguna cuenta con ese correo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HogarFin - Iniciar sesión</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body class="pantalla-auth">

    <main class="tarjeta-auth">
        <div class="marca-auth">
            <h2>🏠 HogarFin</h2>
            <p>Planificación económica familiar</p>
        </div>

        <h1>Iniciar sesión</h1>
        <p class="subtitulo-auth">Accede al espacio privado de tu familia.</p>

        <?php if ($error != "") { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>

        <form action="login.php" method="post" class="formulario-auth">
            <div class="campo">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="campo-input" placeholder="ejemplo@familia.com" required>
            </div>

            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="campo-input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="boton-principal boton-ancho">Entrar en mi familia</button>
        </form>

        <p class="pie-auth">
            ¿Aún no tienes cuenta familiar? <a href="registro.php" class="enlace">Crear una familia</a>
        </p>
    </main>

</body>

</html>
