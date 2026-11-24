<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$pagina = "reservas";
include "header.php";
?>

<div class="bienvenida">
    <div>
        <h2>Fondos de reserva 🛡️</h2>
        <p>Las transferencias a reservas mueven dinero propio; una misma cantidad no puede estar en dos fondos.</p>
    </div>
</div>

<div class="tarjetas-resumen">
    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Total reservado real</span><span class="icono verde" aria-hidden="true">€</span></div>
        <h2>8.200,00 €</h2>
        <p class="texto-verde">Restado del saldo disponible</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Fondo de emergencia</span><span class="icono azul" aria-hidden="true">◉</span></div>
        <h2>4.500,00 €</h2>
        <p class="texto-gris">Configurado: 3 meses de esenciales</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Fondo de reparaciones</span><span class="icono naranja" aria-hidden="true">🔧</span></div>
        <h2>400,00 €</h2>
        <p class="texto-gris">Objetivo: 1.500,00 €</p>
    </article>

    <article class="tarjeta">
        <div class="tarjeta-cabecera"><span>Fons de substitució</span><span class="icono morado" aria-hidden="true">📦</span></div>
        <h2>3.300,00 €</h2>
        <p class="texto-gris">Lavadora, nevera y coche</p>
    </article>
</div>

<!-- 1. Fondo de sustitución por bien -->
<div class="panel">
    <div class="panel-cabecera">
        <div>
            <h2>1. Fondos de sustitución (vinculados al inventario)</h2>
            <p>Aportación necesaria = máx(0, coste futuro − reservado) / meses restantes</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Bien</th>
                <th>Objetivo</th>
                <th>Saldo reservado</th>
                <th>Plazo</th>
                <th>Aportación necesaria</th>
                <th>Déficit / Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Lavadora</td>
                <td>600,00 €</td>
                <td>120,00 €</td>
                <td>24 meses</td>
                <td>20,00 €/mes</td>
                <td>Faltan 480,00 €</td>
            </tr>
            <tr>
                <td>Nevera</td>
                <td>900,00 €</td>
                <td>180,00 €</td>
                <td>36 meses</td>
                <td>20,00 €/mes</td>
                <td>Faltan 720,00 €</td>
            </tr>
            <tr>
                <td>Cotxe</td>
                <td>12.000,00 €</td>
                <td>3.000,00 €</td>
                <td>60 meses</td>
                <td>150,00 €/mes</td>
                <td>Faltan 9.000,00 €</td>
            </tr>
            <tr>
                <td>Caldera</td>
                <td>1.800,00 €</td>
                <td>1.500,00 €</td>
                <td><span class="etiqueta-roja">Vencido (0 meses)</span></td>
                <td>— (Define nuevo plazo)</td>
                <td class="importe-negativo">Déficit inmediato: 300,00 €</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- 2. Reparaciones y Emergencias + Registrar aportación / uso -->
<div class="fila-dashboard">
    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>2. Reparaciones y emergencias</h2>
                <p>Objetivos independientes configurables</p>
            </div>
        </div>

        <div class="presupuesto">
            <div class="presupuesto-cabecera">
                <span>🛡️ Fondo de emergencia (3 meses × 2.000,00 € esenciales)</span>
                <strong>4.500,00 € / 6.000,00 €</strong>
            </div>
            <div class="barra"><div class="barra-verde" style="width:75%"></div></div>
            <p class="texto-gris">Aportación planificada: 200,00 €/mes · Déficit: 1.500,00 €</p>
        </div>

        <div class="presupuesto">
            <div class="presupuesto-cabecera">
                <span>🔧 Fondo de reparaciones (Objetivo independiente)</span>
                <strong>400,00 € / 1.500,00 €</strong>
            </div>
            <div class="barra"><div class="barra-azul" style="width:27%"></div></div>
            <p class="texto-gris">Aportación planificada: 60,00 €/mes · Déficit: 1.100,00 €</p>
        </div>
    </article>

    <article class="panel">
        <div class="panel-cabecera">
            <div>
                <h2>Registrar aportación o pagar reparación</h2>
                <p>Al pagar una reparación, se registra un único gasto y se descuenta de la reserva</p>
            </div>
        </div>

        <form action="reservas.php" method="post">
            <div class="campo">
                <label for="res_accion">Operación</label>
                <select id="res_accion" name="accion" class="selector selector-ancho">
                    <option value="aportar">Aportación efectuada a reserva (traspaso interno)</option>
                    <option value="gastar_reparacion">Pagar reparación usando fondo (1 solo gasto)</option>
                </select>
            </div>
            <div class="campo">
                <label for="res_fondo">Fondo destino / origen</label>
                <select id="res_fondo" name="fondo" class="selector selector-ancho">
                    <option>Fondo de reparaciones (Saldo: 400,00 €)</option>
                    <option>Fondo de emergencia (Saldo: 4.500,00 €)</option>
                    <option>Sustitución Lavadora (Saldo: 120,00 €)</option>
                </select>
            </div>
            <div class="campo">
                <label for="res_importe">Importe (€)</label>
                <input type="number" id="res_importe" name="importe" step="0.01" min="0.01" class="campo-input" required>
            </div>
            <button type="submit" class="boton-principal boton-ancho">Ejecutar movimiento de reserva</button>
        </form>
    </article>
</div>

<?php include "footer.php"; ?>