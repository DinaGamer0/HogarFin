<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$pagina = "avisos";
include "header.php";
?>

<div class="bienvenida">
    <div>
        <h2>Previsión a 12 meses, escenarios y avisos 🔔</h2>
        <p>Anticipa saldos negativos, vencimientos anuales y el impacto de cambios en tu economía.</p>
    </div>
</div>

<!-- Avisos con icono + etiqueta textual + color (accesible) -->
<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Avisos activos del sistema</h2>
            <p>Alertas automáticas por desviaciones, plazos vencidos o margen negativo</p>
        </div>
    </div>

    <div class="aviso aviso-rojo" role="alert">
        <div class="aviso-icono" aria-hidden="true">⛔</div>
        <div>
            <strong>[CRÍTICO] Plazo vencido en sustitución de Caldera</strong>
            <p>Faltan 300,00 € para cubrir el coste estimado. Define un nuevo plazo en Inventario.</p>
        </div>
    </div>

    <div class="aviso aviso-naranja" role="status">
        <div class="aviso-icono" aria-hidden="true">⚠️</div>
        <div>
            <strong>[ATENCIÓN] Presupuesto de suministros excedido (+25,50 €)</strong>
            <p>El gasto real supera el límite previsto para este mes.</p>
        </div>
    </div>

    <div class="aviso aviso-azul" role="status">
        <div class="aviso-icono" aria-hidden="true">📅</div>
        <div>
            <strong>[PRÓXIMO RECIBO] Agua trimestral (01/12/2026)</strong>
            <p>Importe previsto: 48,00 €.</p>
        </div>
    </div>
</div>

<!-- Simulador de escenarios -->
<div class="fila-dashboard">
    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Simulador de escenarios ("¿Qué pasa si...?")</h2>
                <p>Modifica ingresos, gastos, cuota hipotecaria o simula una avería</p>
            </div>
        </div>

        <form action="avisos.php" method="get">
            <div class="campo">
                <label for="esc_ingresos">Variación mensual de ingresos (€)</label>
                <input type="number" id="esc_ingresos" name="var_ingresos" step="0.01" value="-500.00" class="campo-input">
            </div>
            <div class="campo">
                <label for="esc_gastos">Variación mensual de gastos (€)</label>
                <input type="number" id="esc_gastos" name="var_gastos" step="0.01" value="0.00" class="campo-input">
            </div>
            <div class="campo">
                <label for="esc_averia">Avería puntual imprevista (€)</label>
                <input type="number" id="esc_averia" name="averia" step="0.01" min="0" value="650.00" class="campo-input">
            </div>
            <button type="submit" class="boton-principal boton-ancho">Simular escenario</button>
        </form>
    </article>

    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Resultado del escenario simulado</h2>
                <p>Comparado con el caso base (3.000 € ingresos / 2.300 € gastos / 450 € reservas)</p>
            </div>
        </div>

        <div class="dato-linea"><span>Nuevo resultado mensual</span><strong>200,00 €</strong></div>
        <div class="dato-linea"><span>Aportaciones planificadas</span><strong>450,00 €</strong></div>
        <div class="dato-linea"><span>Nuevo margen por asignar</span><strong class="importe-negativo">-250,00 €</strong></div>
        <div class="dato-linea"><span>Cobertura avería (650 € con 400 € reserva)</span><strong class="importe-negativo">250,00 € sin cubrir</strong></div>

        <div class="aviso aviso-rojo" role="alert">
            <div class="aviso-icono" aria-hidden="true">⛔</div>
            <div>
                <strong>[AVISO DE ESCENARIO] Margen mensual negativo (-250,00 €)</strong>
                <p>No se puede cubrir el plan de aportaciones actual sin reducir gastos o ajustar reservas.</p>
            </div>
        </div>
    </article>
</div>

<!-- Proyección a 12 meses -->
<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Proyección a 12 meses</h2>
            <p>Incluye pagas extras y recibos trimestrales/anuales en su mes exacto de vencimiento</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mes</th>
                <th>Ingresos prev.</th>
                <th>Gastos prev. (con vencimientos)</th>
                <th>Aport. reservas</th>
                <th>Saldo acumulado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Dic 2026 (Paga extra)</td>
                <td class="importe-positivo">4.500,00 €</td>
                <td>2.348,00 €</td>
                <td>450,00 €</td>
                <td>3.152,00 €</td>
            </tr>
            <tr>
                <td>Ene 2027</td>
                <td>3.000,00 €</td>
                <td>2.300,00 €</td>
                <td>450,00 €</td>
                <td>3.402,00 €</td>
            </tr>
            <tr>
                <td>Feb 2027 (IBI anual)</td>
                <td>3.000,00 €</td>
                <td>2.750,00 €</td>
                <td>450,00 €</td>
                <td>3.202,00 €</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>