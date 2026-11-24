<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$pagina = "inicio";
include "header.php";
?>

<div class="bienvenida">
    <div>
        <h2>Resumen financiero del hogar 📊</h2>
        <p>Estado actual de ingresos, gastos, reservas y margen disponible.</p>
    </div>
    <a href="#exportar-csv" class="boton-secundario">⬇ Exportar presupuesto CSV</a>
</div>

<section class="tarjetas-resumen">
    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Ingresos del mes</span><span class="icono verde" aria-hidden="true">↗</span></div>
        <h2>3.000,00 €</h2>
        <p class="texto-verde">Cobrados + previstos</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Gastos del mes</span><span class="icono rojo" aria-hidden="true">↘</span></div>
        <h2>2.300,00 €</h2>
        <p class="texto-gris">Resultado mensual: +700,00 €</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Dinero comprometido</span><span class="icono naranja" aria-hidden="true">🛡️</span></div>
        <h2>5.200,00 €</h2>
        <p class="texto-gris">Asignado a reservas</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Disponible tras reservas</span><span class="icono azul" aria-hidden="true">€</span></div>
        <h2>1.450,00 €</h2>
        <p class="texto-verde">Margen mensual por asignar: 250,00 €</p>
    </article>
</section>

<div class="fila-dashboard">
    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Distribución por categorías</h2>
                <p>Gasto real del mes actual</p>
            </div>
        </div>

        <div class="grafico-falso">
            <div class="grafico-circular" role="img" aria-label="Gráfico de distribución de gastos: Vivienda 35%, Alimentación 22%, Transporte 11%, Otros 32%">
                <div class="grafico-centro">
                    <strong>2.300,00 €</strong>
                    <span>Total mes</span>
                </div>
            </div>

            <div class="leyenda">
                <div><span class="punto punto-verde"></span>Vivienda<strong>800,00 €</strong></div>
                <div><span class="punto punto-azul"></span>Alimentación<strong>500,00 €</strong></div>
                <div><span class="punto punto-naranja"></span>Transporte<strong>250,00 €</strong></div>
                <div><span class="punto punto-morado"></span>Resto categorías<strong>750,00 €</strong></div>
            </div>
        </div>
    </article>

    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Evolución mensual (Ingresos vs Gastos)</h2>
                <p>Últimos 6 meses</p>
            </div>
        </div>

        <div class="grafico-barras">
            <div class="mes-barra"><span>Jul</span>
                <div class="barra">
                    <div class="barra-verde" style="width:78%"></div>
                </div><strong>+650 €</strong>
            </div>
            <div class="mes-barra"><span>Ago</span>
                <div class="barra">
                    <div class="barra-verde" style="width:62%"></div>
                </div><strong>+420 €</strong>
            </div>
            <div class="mes-barra"><span>Sep</span>
                <div class="barra">
                    <div class="barra-verde" style="width:80%"></div>
                </div><strong>+700 €</strong>
            </div>
            <div class="mes-barra"><span>Oct</span>
                <div class="barra">
                    <div class="barra-verde" style="width:75%"></div>
                </div><strong>+610 €</strong>
            </div>
            <div class="mes-barra"><span>Nov</span>
                <div class="barra">
                    <div class="barra-verde" style="width:82%"></div>
                </div><strong>+700 €</strong>
            </div>
        </div>
    </article>
</div>

<div class="fila-dashboard">
    <section class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Últimos movimientos</h2>
                <p>Registros recientes del hogar</p>
            </div>
            <a href="ingresos_gastos.php" class="enlace">Ver historial →</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Compra supermercado</td>
                    <td>Alimentación</td>
                    <td>20/11/2026</td>
                    <td class="importe-negativo">-120,00 €</td>
                </tr>
                <tr>
                    <td>Nómina</td>
                    <td>Ingresos</td>
                    <td>18/11/2026</td>
                    <td class="importe-positivo">+1.800,00 €</td>
                </tr>
                <tr>
                    <td>Hipoteca</td>
                    <td>Vivienda</td>
                    <td>05/11/2026</td>
                    <td class="importe-negativo">-800,00 €</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Avisos activos</h2>
                <p>Alertas que requieren atención</p>
            </div>
            <a href="avisos.php" class="enlace">Ver todos →</a>
        </div>

        <div class="aviso aviso-naranja" role="status">
            <div class="aviso-icono" aria-hidden="true">⚠️</div>
            <div>
                <strong>Presupuesto de vivienda al 93 %</strong>
                <p>Quedan 50,00 € disponibles este mes.</p>
            </div>
        </div>

        <div class="aviso aviso-rojo" role="alert">
            <div class="aviso-icono" aria-hidden="true">⛔</div>
            <div>
                <strong>Fondo de sustitución vencido</strong>
                <p>La caldera tiene plazo vencido con un déficit de 300,00 €.</p>
            </div>
        </div>
    </section>
</div>

<?php include "footer.php"; ?>