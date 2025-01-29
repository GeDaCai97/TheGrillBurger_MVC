<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Extra</legend>
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input 
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre Extra"
            value="<?php echo $extra->nombre; ?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="precio" class="formulario__label">Precio</label>
        <input 
            type="number"
            class="formulario__input"
            id="precio"
            name="precio"
            placeholder="Precio Extra"
            value="<?php echo $extra->precio; ?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="Categorias_id" class="formulario__label">Categoria del Artículo</label>
        <select class="formulario__select" id="Categorias_id" name="Categorias_id">
            <option value="">- Seleccionar -</option>
            <?php foreach($categorias as $categoria) { ?>
                <option <?php echo ($extra->Categorias_id === $categoria->id) ? 'selected' : ''; ?> value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
            <?php } ?>
        </select>
    </div>
</fieldset>