<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php  if(is_auth()) {?>
                <?php if(is_adminAdv()) { ?>
                    <a href="/administrador/dashboard" class="header__enlace">Administrador</a>
                <?php } ?>
                <a href="/perfil" class="header__enlace">Hola, <?php echo$_SESSION['nombre'] ?? ''; ?>
                    <i class="fa-solid fa-angle-down"></i>
                </a>
                <a href="/crear-pedido" class="header__enlace">Hacer Pedido</a>
                <form action="/logout" method="POST" class="header__form">
                    <input type="submit" value="Cerrar Sesión" class="header__submit">
                </form>
            <?php } else { ?>
                <a href="/login" class="header__enlace">Iniciar Sesión</a>
                <a href="/registrar" class="header__enlace">Crear Cuenta</a>
            <?php }  ?>
        </nav>
        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">The Grill Burger House</h1>
            </a>
            <p class="header__texto header__texto--modalidad">Jueves - Domingo</p>
            <p class="header__texto">6:30 PM - 11:30 PM</p>
            <?php if(!is_auth()) { ?>
                <a href="/registrar" class="header__boton">Crea tu cuenta</a>
            <?php } ?>
        </div>
    </div>
</header>
<div class="barra">
    <div class="barra__contenido">
        <a href="/">
            <h2 class="barra__logo">
                The Grill Burger House
            </h2>
        </a>
        <nav class="navegacion">
            <a href="/nosotros" class="navegacion__enlace <?php echo pagina_actual('/nosotros') ? 'navegacion__enlace--actual' : ''; ?>">Sobre Nosotros</a>
            <a href="/menu" class="navegacion__enlace <?php echo pagina_actual('/menu') ? 'navegacion__enlace--actual' : ''; ?>">Menú</a>
        </nav>
    </div>
</div>