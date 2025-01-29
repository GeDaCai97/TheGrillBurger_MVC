<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor-boton">
    <a href="/administrador/combos" class="dashboard__boton">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>
<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>
    <form action="/administrador/combos/crear" method="POST" class="formulario">
        <?php include_once __DIR__ . '/formulario.php' ?>
        <input type="submit" value="Registrar Combo" class="formulario__submit formulario__submit--registrar">
    </form>
</div>