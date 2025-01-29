<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu acceso a The Grill Burger House</p>
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <form action="/olvide" class="formulario" method="POST" novalidate>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                id="email"
                name="email"
                class="formulario__input"
                placeholder="Tu E-mail"
            />
        </div>
        <input type="submit" value="Enviar Instrucciones" class="formulario__submit">
    </form>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/registrar" class="acciones__enlace">¿Aún no tienes una cuenta? Crear una</a>
    </div>

</main>

