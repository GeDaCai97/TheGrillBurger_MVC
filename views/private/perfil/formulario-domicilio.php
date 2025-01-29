<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Domicilio</legend>
    <p class="formulario__descripcion">Los campos con * son obligatorios.</p>
    <div class="formulario__campo">
        <label for="calle" class="formulario__label">*Calle</label>
        <input 
            type="text"
            class="formulario__input"
            id="calle"
            name="calle"
            placeholder="Tu Calle"
            value="<?php echo $domicilio->calle; ?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="colonia" class="formulario__label">*Colonia</label>
        <input 
            type="text"
            class="formulario__input"
            id="colonia"
            name="colonia"
            placeholder="Tu Colonia"
            value="<?php echo $domicilio->colonia; ?>"
        />
    </div>
    <div class="formulario__grid">
        <div class="formulario__campo">
            <label for="numexterior" class="formulario__label">*Número exterior</label>
            <input 
                type="number"
                class="formulario__input"
                id="numexterior"
                name="numexterior"
                placeholder="Tu número exterior"
                value="<?php echo $domicilio->numexterior; ?>"
            />
        </div>
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Número Interior</label>
            <input 
                type="number"
                class="formulario__input"
                id="numinterior"
                name="numinterior"
                placeholder="Tu número interior (opcional)"
                value="<?php echo $domicilio->numinterior; ?>"
            />
        </div>
    </div>
    <div class="formulario__campo">
        <label for="codigoPostal" class="formulario__label">*Código Postal</label>
        <input 
            type="number"
            class="formulario__input"
            id="codigoPostal"
            name="codigoPostal"
            placeholder="Tu código postal"
            value="<?php echo $domicilio->codigoPostal; ?>"
        />
    </div>
    <div class="formulario__campo">
        <label for="referencias" class="formulario__label">*Referencias</label>
        <textarea 
            class="formulario__input"
            id="referencias"
            name="referencias"
            placeholder="Referencias"
            rows="4"
        ><?php echo $domicilio->referencias; ?></textarea>
    </div>
</fieldset>