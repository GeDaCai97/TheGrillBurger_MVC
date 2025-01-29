<div class="articulo-menu <?php echo $articulo->imagen ? 'articulo-menu--imagen' : ''; ?>">
    
    <?php if($articulo->imagen) { ?>
        <div class="articulo-menu__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen; ?>.avif" type="image/avif">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen; ?>.webp" type="image/webp">
                <img loading="lazy" src="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen; ?>.png" alt="Imagen Articulo">
            </picture>
        </div>
    <?php } ?>
    <div class="articulo-menu__contenido">
        <h4 class="articulo-menu__nombre"><?php echo $articulo->nombre; ?></h4>
        <div class="articulo-menu__informacion">
            <div class="articulo-menu__datos">
                <p class="articulo-menu__descripcion"><?php echo $articulo->descripcion; ?></p>
                <p class="articulo-menu__precio--p">$<span class="articulo-menu__precio"><?php echo $articulo->precio_articulo; ?></span></p>
            </div>
        </div>
        <div class="articulo-menu__extras-contenedor">
            <?php if($articulo->extras) { ?>
                <h4 class="articulo-menu__extras-titulo">Extras</h4>
                <div class="articulo-menu__extras-contenido">
                    <?php foreach($articulo->extras as $extra) { ?>
                        <div class="articulo-menu__extra" data-id="<?php echo $extra->id; ?>"><?php echo $extra->nombre; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>

        </div>
        <div class="articulo-menu__contenedor-form">
            <form class="formulario-articulo" action="" id="registro">
                <div class="formulario-articulo__campo">
                    <label for="cantidad" class="formulario-articulo__label">Cantidad</label>
                    <input 
                        type="number"
                        class="formulario-articulo__input"
                        id="cantidad"
                        name="cantidad"
                        placeholder="0"
                        min="1"
                        value="1"
                    />
                </div>
            </form>
            <button
                type="button"
                data-id="<?php echo $articulo->id ?>"
                class="articulo-menu__agregar"
            >
                Agregar
                <i class="fa-solid fa-circle-plus"></i>
            </button>
        </div>
    </div>
</div>