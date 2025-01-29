<h2 class="domicilio__heading"><?php echo $titulo; ?></h2>
<div class="domicilio">
    <div class="domicilio__contenedor-boton">
        <a href="/perfil" class="domicilio__boton">
        <i class="fa-solid fa-angle-left"></i>
            Domicilio
        </a>
    </div>
    <div class="domicilio__formulario">
        <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>
        <form action="/perfil/domicilio" method="POST" class="formulario">
            <?php include_once __DIR__ . '/formulario-domicilio.php' ?>
            <input type="submit" value="Guardar cambios" class="formulario__submit formulario__submit--registrar">
        </form>
    </div>
</div>