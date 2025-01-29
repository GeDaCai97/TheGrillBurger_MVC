<main class="crear-pedido">
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
            <h3 class="pedido-registro__heading">Pedido</h3>
            <div class="pedido-registro__resumen" id="pedido-registro-resumen"></div>
            <div class="articulo-menu__precio--total" id="total"></div>
            <div class="formulario__campo">
                <label for="domicilio" class="formulario__label">Tipo de entrega:</label>
                <select name="domicilio" id="domicilio" class="formulario__select">
                    <option value="">-- Selecciona un tipo de entrega --</option>
                    <option value="1">Recoger</option>
                    <option value="2">A Domicilio</option>
                </select>
            </div>
            <div class="formulario__campo">
                <label for="comentario" class="formulario__label">Comentario</label>
                <textarea 
                    class="formulario__input"
                    id="comentario"
                    name="comentario"
                    placeholder="Deja tu Comentario"
                    rows="4"
                ></textarea>
            </div>
            <form id="crear-pedido" class="formulario">
                <div class="formulario__campo">
                    <input type="submit" class="formulario__submit" value="Crear Pedido">
                </div>
            </form>
        </aside>
    </div>
</main>