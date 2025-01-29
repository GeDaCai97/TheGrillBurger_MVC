<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Combo</legend>
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input 
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre del Combo"
            value="<?php echo $combo->nombre; ?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción del Combo</label>
        <textarea 
            class="formulario__input"
            id="descripcion"
            name="descripcion"
            placeholder="Descripción del Combo"
            rows="4"
        ><?php echo $combo->descripcion; ?></textarea>
    </div>
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Precio del Combo</label>
        <input 
            type="number"
            class="formulario__input"
            id="precio_combo"
            name="precio_combo"
            placeholder="Precio del Combo"
            value="<?php echo $combo->precio_combo; ?>"
        />
    </div>
</fieldset>