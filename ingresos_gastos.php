<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$pagina = "movimientos";
include "header.php";
?>

<div class="bienvenida">
    <div>
        <h2>Ingresos y gastos 💰</h2>
        <p>Registra movimientos reales o previstos y vincula recibos sin duplicarlos.</p>
    </div>
</div>

<!-- Formulario para registrar ingresos o gastos -->
<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Registrar nuevo movimiento</h2>
            <p>Nóminas, pensiones, ayudas, pagas extras o gastos del hogar</p>
        </div>
    </div>

    <form action="ingresos_gastos.php" method="post" class="grid-formulario">
        <div class="campo">
            <label for="mov_tipo">Tipo</label>
            <select id="mov_tipo" name="tipo" class="selector selector-ancho">
                <option value="gasto">Gasto</option>
                <option value="ingreso">Ingreso</option>
            </select>
        </div>

        <div class="campo">
            <label for="mov_concepto">Concepto</label>
            <input type="text" id="mov_concepto" name="concepto" class="campo-input" placeholder="Ej. Nómina, Paga extra, Luz..." required>
        </div>

        <div class="campo">
            <label for="mov_categoria">Categoría</label>
            <select id="mov_categoria" name="categoria" class="selector selector-ancho">
                <option>Nómina / Paga extra</option>
                <option>Pensión / Ayuda</option>
                <option>Hipoteca / Alquiler</option>
                <option>Suministros</option>
                <option>Alimentación</option>
                <option>Transporte</option>
                <option>Educación</option>
                <option>Salud</option>
                <option>Seguros</option>
                <option>Impuestos</option>
                <option>Ocio</option>
            </select>
        </div>

        <div class="campo">
            <label for="mov_importe">Importe neto (€)</label>
            <input type="number" id="mov_importe" name="importe" step="0.01" min="0.01" class="campo-input" placeholder="0,00" required>
        </div>

        <div class="campo">
            <label for="mov_fecha">Fecha (o mes de paga extra)</label>
            <input type="date" id="mov_fecha" name="fecha" class="campo-input" required>
        </div>

        <div class="campo">
            <label for="mov_titular">Titular</label>
            <select id="mov_titular" name="titular" class="selector selector-ancho">
                <option>Laura García</option>
                <option>Carlos García</option>
                <option>Hogar (Compartido)</option>
            </select>
        </div>

        <div class="campo">
            <label for="mov_periodicidad">Periodicidad</label>
            <select id="mov_periodicidad" name="periodicidad" class="selector selector-ancho">
                <option value="puntual">Puntual</option>
                <option value="mensual">Mensual</option>
                <option value="trimestral">Trimestral</option>
                <option value="anual">Anual</option>
            </select>
        </div>

        <div class="campo">
            <label for="mov_estado">Estado</label>
            <select id="mov_estado" name="estado" class="selector selector-ancho">
                <option value="real">Cobrado / Pagado (Real)</option>
                <option value="previsto">Previsto (Pendiente)</option>
            </select>
        </div>

        <div class="campo-boton">
            <button type="submit" class="boton-principal boton-ancho">+ Guardar movimiento</button>
        </div>
    </form>
</div>

<!-- Recibos previstos pendientes de confirmar -->
<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Recibos e ingresos previstos (Pendientes)</h2>
            <p>Al confirmar un movimiento previsto, pasa a real sin duplicar el importe</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Categoría</th>
                <th>Fecha prevista</th>
                <th>Titular</th>
                <th>Importe</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Recibo Agua (Trimestral)</td>
                <td>Suministros</td>
                <td>01/12/2026</td>
                <td>Hogar</td>
                <td class="importe-negativo">-48,00 €</td>
                <td><button type="button" class="boton-principal">✓ Confirmar pago real</button></td>
            </tr>
            <tr>
                <td>Paga extra Navidad</td>
                <td>Nómina</td>
                <td>20/12/2026</td>
                <td>Laura García</td>
                <td class="importe-positivo">+1.500,00 €</td>
                <td><button type="button" class="boton-principal">✓ Confirmar cobro</button></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Historial con filtros -->
<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Historial de movimientos</h2>
            <p>Filtra por fechas y categoría</p>
        </div>
        <form class="filtros-linea" method="get">
            <label for="filtro_desde" class="sr-only">Desde</label>
            <input type="date" id="filtro_desde" name="desde" class="selector">
            <label for="filtro_hasta" class="sr-only">Hasta</label>
            <input type="date" id="filtro_hasta" name="hasta" class="selector">
            <label for="filtro_cat" class="sr-only">Categoría</label>
            <select id="filtro_cat" name="categoria" class="selector">
                <option value="">Todas las categorías</option>
                <option>Vivienda</option>
                <option>Alimentación</option>
                <option>Suministros</option>
            </select>
            <button type="submit" class="boton-secundario">Filtrar</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Categoría</th>
                <th>Titular</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Supermercado</td>
                <td>Alimentación</td>
                <td>Carlos García</td>
                <td>22/11/2026</td>
                <td><span class="etiqueta-verde">Real</span></td>
                <td class="importe-negativo">-85,40 €</td>
            </tr>
            <tr>
                <td>Nómina mensual</td>
                <td>Nómina</td>
                <td>Laura García</td>
                <td>15/11/2026</td>
                <td><span class="etiqueta-verde">Real</span></td>
                <td class="importe-positivo">+1.800,00 €</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>