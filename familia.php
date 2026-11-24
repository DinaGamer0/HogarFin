<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$pagina = "familia";
include "header.php";
?>

<div class="bienvenida">
    <div>
        <h2>Familia y configuración 👨‍👩‍👧‍👦</h2>
        <p>Gestiona los miembros del hogar, sus permisos y las categorías editables.</p>
    </div>
    <span class="etiqueta">ROL: ADMINISTRADOR</span>
</div>

<div class="fila-dashboard">
    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Miembros de la familia</h2>
                <p>Solo los usuarios de esta familia tienen acceso a sus datos</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Laura García</td>
                    <td>laura@familia.com</td>
                    <td><span class="etiqueta-verde">Administrador</span></td>
                    <td>—</td>
                </tr>
                <tr>
                    <td>Carlos García</td>
                    <td>carlos@familia.com</td>
                    <td><span class="etiqueta-naranja">Miembro</span></td>
                    <td><button type="button" class="boton-secundario">Cambiar rol</button></td>
                </tr>
            </tbody>
        </table>
    </article>

    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Añadir miembro</h2>
                <p>Invita o da de alta a un integrante del hogar</p>
            </div>
        </div>

        <form action="familia.php" method="post">
            <div class="campo">
                <label for="miembro_nombre">Nombre</label>
                <input type="text" id="miembro_nombre" name="miembro_nombre" class="campo-input" required>
            </div>
            <div class="campo">
                <label for="miembro_email">Correo electrónico</label>
                <input type="email" id="miembro_email" name="miembro_email" class="campo-input" required>
            </div>
            <div class="campo">
                <label for="miembro_rol">Rol en el hogar</label>
                <select id="miembro_rol" name="miembro_rol" class="selector selector-ancho">
                    <option value="miembro">Miembro (registrar movimientos y consultar)</option>
                    <option value="admin">Administrador (gestión total)</option>
                </select>
            </div>
            <button type="submit" class="boton-principal boton-ancho">+ Añadir miembro</button>
        </form>
    </article>
</div>

<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Categorías de gastos editables</h2>
            <p>Personaliza las categorías disponibles en presupuestos y movimientos</p>
        </div>
    </div>

    <form action="familia.php" method="post" class="fila-formulario">
        <div class="campo">
            <label for="nueva_categoria">Nueva categoría</label>
            <input type="text" id="nueva_categoria" name="nueva_categoria" class="campo-input" placeholder="Ej. Mascotas">
        </div>
        <div class="campo">
            <label for="tipo_categoria">Clasificación</label>
            <select id="tipo_categoria" name="tipo_categoria" class="selector selector-ancho">
                <option value="esencial">Gasto esencial</option>
                <option value="prescindible">Gasto flexible / ocio</option>
            </select>
        </div>
        <button type="submit" class="boton-principal">Guardar categoría</button>
    </form>
</div>

<?php include "footer.php"; ?>