<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Artículo</legend>
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input 
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre Artículo"
            value="<?php echo $articulo->nombre; ?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="precio_articulo" class="formulario__label">Precio del Artículo</label>
        <input 
            type="number"
            class="formulario__input"
            id="precio_articulo"
            name="precio_articulo"
            placeholder="Precio del Artículo"
            value="<?php echo $articulo->precio_articulo; ?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen</label>
        <input 
            type="file"
            class="formulario__input formulario__input--file"
            id="imagen"
            name="imagen"
        />
    </div>
    <?php if(isset($articulo->imagen_actual)) { ?>
        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <?php if($articulo->imagen_actual) { ?>
                <picture>
                    <source srcset="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen_actual; ?>.avif" type="image/avif">
                    <source srcset="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen_actual; ?>.webp" type="image/webp">
                    <img src="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen_actual; ?>.png" alt="Imagen Ponente">
                </picture>
            <?php } else { ?>
                <p class="formulario__texto">No hay Imagen</p>
            <?php } ?>
            
        </div>
    <?php } ?>
    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción Artículo</label>
        <textarea 
            class="formulario__input"
            id="descripcion"
            name="descripcion"
            placeholder="Descripción Artículo"
            rows="4"
        ><?php echo $articulo->descripcion; ?></textarea>
    </div>
    <div class="formulario__campo">
        <label for="Categorias_id" class="formulario__label">Categoria del Artículo</label>
        <select class="formulario__select" id="Categorias_id" name="Categorias_id">
            <option value="">- Seleccionar -</option>
            <?php foreach($categorias as $categoria) { ?>
                <option <?php echo ($articulo->Categorias_id === $categoria->id) ? 'selected' : ''; ?> value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
            <?php } ?>
        </select>
    </div>
</fieldset>