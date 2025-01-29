<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor-boton">
    <a href="/administrador/combos" class="dashboard__boton">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>
<div class="crear-pedido">
    <h2 class="crear-pedido__heading">Crear Pedido</h2>
    <p class="crear-pedido__descripcion">Ordena en The Grill Burger House</p>
    <nav class="menu__navegacion">
        <?php if($categorias) { ?>
            <?php foreach($categorias as $categoria) { ?>
                <a href="#<?php echo $categoria->id; ?>" class="menu__enlace"><?php echo $categoria->nombre; ?></a>
            <?php } ?>
        <?php } else { ?>
            <p class="menu__descripcion">No hay categorías disponibles</p>
        <?php } ?>
    </nav>
    
    <div class="menu-listado">
        <div class="menu-listado__principal">
            <h3 class="menu-listado__heading">Menú</h3>
            <?php if($categorias) { ?>
                <?php foreach($categorias as $categoria) { ?>
                    <div class="menu-listado__seccion" id="<?php echo $categoria->id; ?>">
                        <h3 class="menu-seccion__titulo"><?php echo $categoria->nombre; ?></h3>
                        <div class="menu-listado__grid">
                            <?php foreach($categoria->articulos as $articulo) { ?>
                                <?php include __DIR__ . '/../../components/articulo.php'; ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p class="menu-listado__descripcion">No disponible</p>
            <?php } ?>
        </div>
        <aside class="pedido-registro">
            <h3 class="pedido-registro__heading">Contenido</h3>
            <div class="pedido-registro__resumen" id="combo-registro-resumen"></div>
            <div class="articulo-menu__precio--total" id="total"></div>
            <form id="actualizar-combo" class="formulario">
                <div class="formulario__campo">
                    <input type="hidden" name="Combos_id" value="<?php echo $Combos_id; ?>">
                </div>
            </form>
        </aside>
    </div>
</div>