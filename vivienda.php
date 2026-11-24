<?php
$pagina = "vivienda";
include "header.php";
?>

<div class="bienvenida">
    <div>
        <h2>Vivienda y préstamos 🏠</h2>
        <p>Registra la cuota real del contrato o simula escenarios de tipo de interés.</p>
    </div>
    <span class="etiqueta">VIVIENDA EN PROPIEDAD</span>
</div>

<div class="tarjetas-resumen">
    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Cuota real registrada</span><span class="icono azul" aria-hidden="true">€</span></div>
        <h2>650,00 €</h2>
        <p class="texto-gris">Según recibo bancario</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Capital pendiente</span><span class="icono naranja" aria-hidden="true">⌂</span></div>
        <h2>120.000,00 €</h2>
        <p class="texto-gris">Deuda actual</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Plazo restante</span><span class="icono verde" aria-hidden="true">◷</span></div>
        <h2>240 meses</h2>
        <p class="texto-gris">20 años pendientes</p>
    </article>
</div>

<div class="fila-dashboard">
    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Registrar cuota real del préstamo</h2>
                <p>El simulador no sustituye la cuota real del contrato</p>
            </div>
        </div>

        <form action="vivienda.php" method="post">
            <div class="campo">
                <label for="cuota_real">Cuota mensual real (€)</label>
                <input type="number" id="cuota_real" name="cuota_real" step="0.01" min="0" value="650.00" class="campo-input" required>
            </div>
            <div class="campo">
                <label for="capital_real">Capital pendiente actual (€)</label>
                <input type="number" id="capital_real" name="capital_real" step="0.01" min="0" value="120000.00" class="campo-input" required>
            </div>
            <div class="campo">
                <label for="tin_real">TIN anual actual (%)</label>
                <input type="number" id="tin_real" name="tin_real" step="0.01" min="0" value="2.80" class="campo-input" required>
            </div>
            <div class="campo">
                <label for="meses_real">Meses restantes</label>
                <input type="number" id="meses_real" name="meses_real" min="1" value="240" class="campo-input" required>
            </div>
            <button type="submit" class="boton-secundario boton-ancho">Actualizar datos reales</button>
        </form>
    </article>

    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Simulador hipotecario (Cuota constante)</h2>
                <p>Prueba cambios de TIN (admite 0 % sin asumir tipos futuros)</p>
            </div>
        </div>

        <form action="vivienda.php" method="get">
            <div class="campo">
                <label for="sim_capital">Capital pendiente (€)</label>
                <input type="number" id="sim_capital" name="capital" step="0.01" min="0.01" value="120000.00" class="campo-input" required>
            </div>

            <div class="campo">
                <label for="sim_tin">TIN anual simulado (%)</label>
                <input type="number" id="sim_tin" name="tin" step="0.01" min="0" value="2.80" class="campo-input" required>
            </div>

            <div class="campo">
                <label for="sim_meses">Plazo restante (meses)</label>
                <input type="number" id="sim_meses" name="meses" min="1" value="240" class="campo-input" required>
            </div>

            <div class="resultado-simulador">
                <span>Cuota mensual simulada</span>
                <h2>653,51 €</h2>
                <p>Mes 1: 280,00 € intereses · 373,51 € amortización</p>
            </div>

            <button type="submit" class="boton-principal boton-ancho">Calcular simulación</button>
        </form>

        <p class="nota">Aviso: La simulación supone cuota mensual y tipo constante sin comisiones ni seguros, y no sustituye la cuota real del contrato.</p>
    </article>
</div>

<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>Desglose de amortización e intereses (Primeros meses)</h2>
            <p>Actualización mensual del capital pendiente y ajuste por redondeo en la última cuota</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mes</th>
                <th>Cuota</th>
                <th>Intereses</th>
                <th>Amortización</th>
                <th>Capital pendiente</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mes 1</td>
                <td>653,51 €</td>
                <td>280,00 €</td>
                <td>373,51 €</td>
                <td>119.626,49 €</td>
            </tr>
            <tr>
                <td>Mes 2</td>
                <td>653,51 €</td>
                <td>279,13 €</td>
                <td>374,38 €</td>
                <td>119.252,11 €</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>