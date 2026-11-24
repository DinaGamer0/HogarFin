<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$pagina = "inventario";
include "header.php";
?>

<div class="bienvenida">
    <div>
        <h2>Inventario familiar 📦</h2>
        <p>Control de bienes, vida útil estimada, garantías y planificación de sustitución.</p>
    </div>
</div>

<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Registrar o actualizar bien</h2>
            <p>La fecha estimada de sustitución es una hipótesis de planificación, no una predicción de avería</p>
        </div>
    </div>

    <form action="inventario.php" method="post" class="grid-formulario">
        <div class="campo">
            <label for="bien_nombre">Nombre del bien</label>
            <input type="text" id="bien_nombre" name="nombre" class="campo-input" placeholder="Ej. Lavadora" required>
        </div>
        <div class="campo">
            <label for="bien_fecha">Fecha de compra</label>
            <input type="date" id="bien_fecha" name="fecha_compra" class="campo-input" required>
        </div>
        <div class="campo">
            <label for="bien_coste">Coste de compra (€)</label>
            <input type="number" id="bien_coste" name="coste" step="0.01" min="0" class="campo-input" required>
        </div>
        <div class="campo">
            <label for="bien_vida">Vida útil estimada (años)</label>
            <input type="number" id="bien_vida" name="vida_util" min="1" class="campo-input" required>
        </div>
        <div class="campo">
            <label for="bien_estado">Estado actual</label>
            <select id="bien_estado" name="estado" class="selector selector-ancho">
                <option>Bueno</option>
                <option>Revisar / Mantenimiento</option>
                <option>Desgastado</option>
            </select>
        </div>
        <div class="campo">
            <label for="bien_garantia">Fin de garantía</label>
            <input type="date" id="bien_garantia" name="garantia" class="campo-input">
        </div>
        <div class="campo">
            <label for="bien_mantenimiento">Último / próximo mantenimiento</label>
            <input type="text" id="bien_mantenimiento" name="mantenimiento" class="campo-input" placeholder="Ej. Revisión anual Nov 2026">
        </div>
        <div class="campo">
            <label for="bien_coste_futuro">Coste futuro estimado (€)</label>
            <input type="number" id="bien_coste_futuro" name="coste_futuro" step="0.01" min="0" class="campo-input" required>
        </div>
        <div class="campo-boton">
            <button type="submit" class="boton-principal boton-ancho">+ Guardar bien</button>
        </div>
    </form>
</div>

<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Bienes inventariados</h2>
            <p>Puedes revisar la fecha estimada de sustitución según uso, estado o reparaciones</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Bien</th>
                <th>Compra / Garantía</th>
                <th>Sustitución (Hipótesis)</th>
                <th>Estado / Mantenimiento</th>
                <th>Coste futuro</th>
                <th>Ahorro asignado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>🧺 Lavadora</td>
                <td>15/11/2020 (Sin garantía)</td>
                <td>Nov 2028 (24 meses rest.)</td>
                <td><span class="etiqueta-verde">✓ Bueno</span> · Filtro limpio</td>
                <td>600,00 €</td>
                <td>120,00 € (20,00 €/mes)</td>
            </tr>
            <tr>
                <td>🧊 Nevera</td>
                <td>10/11/2019 (Sin garantía)</td>
                <td>Nov 2029 (36 meses rest.)</td>
                <td><span class="etiqueta-verde">✓ Bueno</span> · Sin incidencias</td>
                <td>900,00 €</td>
                <td>180,00 € (20,00 €/mes)</td>
            </tr>
            <tr>
                <td>🚗 Cotxe</td>
                <td>01/11/2021 (Garantía 11/2026)</td>
                <td>Nov 2031 (60 meses rest.)</td>
                <td><span class="etiqueta-naranja">! Revisar</span> · ITV + Aceite</td>
                <td>12.000,00 €</td>
                <td>3.000,00 € (150,00 €/mes)</td>
            </tr>
            <tr>
                <td>🔥 Caldera</td>
                <td>12/05/2014 (Sin garantía)</td>
                <td><span class="etiqueta-roja">⛔ Plazo vencido</span></td>
                <td><span class="etiqueta-roja">! Desgastada</span> · Revisión anual</td>
                <td>1.800,00 €</td>
                <td>1.500,00 € (Déficit: 300,00 €)</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>