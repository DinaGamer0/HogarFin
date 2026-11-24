<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$pagina = "presupuestos";
include "header.php";
?>

<div class="bienvenida">
    <div>
        <h2>Control de presupuestos 📊</h2>
        <p>Compara importes previstos y reales (mensual y anual) y detecta desviaciones.</p>
    </div>
    <div class="acciones-cabecera">
        <select class="selector" aria-label="Periodo del presupuesto">
            <option value="mensual">Vista Mensual (Noviembre 2026)</option>
            <option value="anual">Vista Anual (2026)</option>
        </select>
        <button type="button" class="boton-secundario">⬇ Exportar CSV</button>
    </div>
</div>

<div class="tarjetas-resumen">
    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Ingresos previstos</span><span class="icono verde" aria-hidden="true">↗</span></div>
        <h2>3.000,00 €</h2>
        <p class="texto-gris">Neto mensual</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Gastos presupuestados</span><span class="icono azul" aria-hidden="true">€</span></div>
        <h2>2.300,00 €</h2>
        <p class="texto-gris">Resultado esperado: +700,00 €</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Aportaciones a reservas</span><span class="icono naranja" aria-hidden="true">🛡️</span></div>
        <h2>450,00 €</h2>
        <p class="texto-gris">Planificadas este mes</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Margen por asignar</span><span class="icono verde" aria-hidden="true">✓</span></div>
        <h2>250,00 €</h2>
        <p class="texto-verde">Resultado − Reservas</p>
    </article>
</div>

<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Asignar presupuesto por categoría</h2>
            <p>Configura el importe previsto mensual o anual</p>
        </div>
    </div>

    <form action="presupuestos.php" method="post" class="fila-formulario">
        <div class="campo">
            <label for="pres_categoria">Categoría</label>
            <select id="pres_categoria" name="categoria" class="selector selector-ancho">
                <option>Vivienda (Hipoteca / Alquiler)</option>
                <option>Suministros</option>
                <option>Alimentación</option>
                <option>Transporte</option>
                <option>Seguros</option>
                <option>Educación</option>
                <option>Salud</option>
                <option>Impuestos</option>
                <option>Ocio</option>
            </select>
        </div>
        <div class="campo">
            <label for="pres_periodicidad">Periodicidad</label>
            <select id="pres_periodicidad" name="periodicidad" class="selector selector-ancho">
                <option value="mensual">Mensual</option>
                <option value="trimestral">Trimestral</option>
                <option value="anual">Anual (al mes de vencimiento)</option>
            </select>
        </div>
        <div class="campo">
            <label for="pres_importe">Importe previsto (€)</label>
            <input type="number" id="pres_importe" name="importe" step="0.01" min="0" class="campo-input" placeholder="0,00" required>
        </div>
        <button type="submit" class="boton-principal">Guardar presupuesto</button>
    </form>
</div>

<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Desviaciones por categoría</h2>
            <p>Comparación entre presupuesto previsto y gasto real ejecutado</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Previsto</th>
                <th>Real</th>
                <th>Desviación</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Vivienda</td>
                <td>800,00 €</td>
                <td>800,00 €</td>
                <td>0,00 €</td>
                <td><span class="etiqueta-verde">✓ En presupuesto</span></td>
            </tr>
            <tr>
                <td>Suministros</td>
                <td>200,00 €</td>
                <td>225,50 €</td>
                <td class="importe-negativo">+25,50 €</td>
                <td><span class="etiqueta-roja">▲ Excedido</span></td>
            </tr>
            <tr>
                <td>Alimentación</td>
                <td>500,00 €</td>
                <td>460,00 €</td>
                <td class="importe-positivo">-40,00 €</td>
                <td><span class="etiqueta-verde">✓ Correcto</span></td>
            </tr>
            <tr>
                <td>Seguro anual coche (Vence Nov)</td>
                <td>600,00 €</td>
                <td>600,00 €</td>
                <td>0,00 €</td>
                <td><span class="etiqueta-verde">✓ Pagado en vencimiento</span></td>
            </tr>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>