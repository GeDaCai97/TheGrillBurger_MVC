<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Coloca tu nuevo password</p>
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <?php if($mostrar) { ?>
    <form class="formulario" method="post">
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Tu Nuevo Password"
                id="password"
                name="password"
            />
        </div>
        <input type="submit" value="Guardar Password" class="formulario__submit">
    </form>
    <?php } ?>
    <div class="acciones">
        <a href="/crear" class="acciones__enlace">¿Aún no tienes una cuenta? Obtener una</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>
</main>