<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en The Grill Burger House</p>
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <form action="/registrar" class="formulario" method="POST">
        <div class="formulario__campo">
            <label class="formulario__label" for="nombre">Nombre</label>
            <input 
                type="text"
                id="nombre"
                name="nombre"
                class="formulario__input"
                placeholder="Tu Nombre"
                value="<?php echo s($usuario->nombre); ?>"
            />
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="apellido">Apellido</label>
            <input 
                type="text"
                id="apellido"
                name="apellido"
                class="formulario__input"
                placeholder="Tu Apellido"
                value="<?php echo s($usuario->apellido); ?>"
            />
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="telefono">Teléfono</label>
            <input 
                type="tel"
                id="telefono"
                name="telefono"
                class="formulario__input"
                placeholder="Tu Teléfono"
                value="<?php echo s($usuario->telefono); ?>"
            />
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="email">E-mail</label>
            <input 
                type="email"
                id="email"
                name="email"
                class="formulario__input"
                placeholder="Tu E-mail"
                value="<?php echo s($usuario->email); ?>"
            />
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="password">Password</label>
            <input 
                type="password"
                id="password"
                name="password"
                class="formulario__input"
                placeholder="Tu Password"
            />
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="password2">Repetir Password</label>
            <input 
                type="password"
                id="password2"
                name="password2"
                class="formulario__input"
                placeholder="Repite tu Password"
            />
        </div>
        <input type="submit" value="Crear Cuenta" class="formulario__submit">
    </form>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>

</main>




