<main class="perfil">
    <h2 class="perfil__heading">Perfil: <?php echo $_SESSION['nombre']; ?></h2>
    <p class="perfil__descripcion">Edita tu perfil</p>

    <div class="perfil__grid">
        <div class="perfil__formulario perfil__formulario--usuario">
            <p class="formulario__texto">Cuenta Bloqueada: <?php echo $_SESSION['bloqueado'] ? 'Si' : 'No'; ?> <span class="mas-info" id="bloqueado-info"><i class="fa-solid fa-circle-info"></i></span></p>
            <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>
            <form action="/perfil" method="POST" class="formulario">
                <?php include_once __DIR__ . '/formulario-usuario.php' ?>
                <input type="submit" value="Guardar cambios" class="formulario__submit formulario__submit--registrar">
            </form>
        </div>
        <div class="perfil__domicilio">
            <div class="dashboard__contenedor-boton">
                <a href="/perfil/domicilio" class="dashboard__boton">
                    Domicilio
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </div>
            <h3>Domicilio</h3>
            <p class="perfil__descripcion">Tus datos actuales de domicilio.</p>
            <?php if($domicilio) { ?>
                <ul class="perfil__lista-domicilio">
                    <li class="perfil__elemento-lista"><span class="perfil__span">Calle:</span> <?php echo $domicilio->calle; ?></li>
                    <li class="perfil__elemento-lista"><span class="perfil__span">Colonia:</span> <?php echo $domicilio->colonia; ?></li>
                    <li class="perfil__elemento-lista"><span class="perfil__span">Número exterior:</span> <?php echo $domicilio->numexterior; ?></li>
                    <li class="perfil__elemento-lista"><span class="perfil__span">Número interior:</span> <?php echo $domicilio->numinterior; ?></li>
                    <li class="perfil__elemento-lista"><span class="perfil__span">Código Postal:</span> <?php echo $domicilio->codigoPostal; ?></li>
                    <li class="perfil__elemento-lista"><span class="perfil__span">Referencias:</span> <p class="perfil__elemento-lista"><?php echo $domicilio->referencias; ?></p></li>
                </ul>
                <hr class="perfil__hr">
            <?php } else { ?>
                <p class="text-center">No tienes un domicilio registrado</p>
            <?php } ?>
        </div>
    </div>
</main>