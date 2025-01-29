<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <?php require_once __DIR__ .'/../templates/alertas.php'; ?>

    <form action="/login" method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Tu Email"
                id="email"
                name="email"
            />
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Tu Password"
                id="password"
                name="password"
            />
        </div>
        <input type="submit" value="Iniciar Sesión" class="formulario__submit">
    </form>
    <div class="acciones">
        <a href="/registrar" class="acciones__enlace">¿Aún no tienes cuenta? Obtener una</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>


</main>