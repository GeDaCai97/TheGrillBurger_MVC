<main class="menu">
    <h2 class="menu__heading"><?php echo $titulo; ?></h2>
    <p class="menu__descripcion">Menú de The Grill Burger House</p>
    <nav class="menu__navegacion">
        <?php if($categorias) { ?>
            <?php foreach($categorias as $categoria) { ?>
                <a href="#<?php echo $categoria->id; ?>" class="menu__enlace"><?php echo $categoria->nombre; ?></a>
            <?php } ?>
        <?php } else { ?>
            <p class="menu__descripcion">No hay categorías disponibles</p>
        <?php } ?>
    </nav>
    <?php if($categorias) { ?>
        <?php foreach($categorias as $categoria) { ?>
            <div id="<?php echo $categoria->id; ?>" class="menu-seccion">
                <h3 class="menu-seccion__titulo"><?php echo $categoria->nombre; ?></h3>
                <div class="menu-seccion__grid">
                    <?php if($categoria->articulos) { ?>
                        <?php foreach($categoria->articulos as $articulo) { ?>
                            <div class="menu-articulo <?php echo (!$articulo->imagen) ? 'menu-articulo--nogrid' : ''; ?>">
                                <?php if($articulo->imagen) { ?>
                                    <div class="menu-articulo__imagen">
                                        <picture>
                                            <source srcset="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen; ?>.avif" type="image/avif">
                                            <source srcset="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen; ?>.webp" type="image/webp">
                                            <img src="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen; ?>.png" alt="Imagen Articulo">
                                        </picture>
                                    </div>
                                <?php } ?>

                                <div class="menu-articulo__contenido">
                                    <h4 class="menu-articulo__titulo"><?php echo $articulo->nombre; ?></h4>
                                    <p class="menu-articulo__descripcion"><?php echo $articulo->descripcion; ?></p>
                                    <span class="menu-articulo__precio">$<?php echo $articulo->precio_articulo; ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="menu-seccion__descripcion">No hay articulos disponibles en esta sección</p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php } else {?>
        <p class="menu__descripcion">No hay menú disponible</p>
    <?php } ?>
</main>