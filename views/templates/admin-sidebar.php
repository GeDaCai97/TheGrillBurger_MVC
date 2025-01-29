<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/administrador/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Inicio
            </span>    
        </a>
        <a href="/administrador/articulos" class="dashboard__enlace <?php echo pagina_actual('/articulos') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-cart-shopping dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Menú
            </span>
        </a>
        <a href="/administrador/categorias" class="dashboard__enlace <?php echo pagina_actual('/categorias') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-list dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Categorías
            </span>    
        </a>
        <a href="/administrador/registrados" class="dashboard__enlace <?php echo pagina_actual('/registrados') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Registrados
            </span>
        </a>
        <a href="/administrador/combos" class="dashboard__enlace <?php echo pagina_actual('/combos') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-burger dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Combos
            </span>    
        </a>
        <a href="/administrador/extras" class="dashboard__enlace <?php echo pagina_actual('/extras') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-plus dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Extras
            </span>    
        </a>
    </nav>
</aside>