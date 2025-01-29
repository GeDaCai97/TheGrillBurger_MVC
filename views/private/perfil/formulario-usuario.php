<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input 
            type="text"
            id="nombre"
            name="nombre"
            class="formulario__input"
            placeholder="Tu Nombre"
            value="<?php echo s($usuario->nombre); ?>"
        />
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input 
            type="text"
            id="apellido"
            name="apellido"
            class="formulario__input"
            placeholder="Tu Apellido"
            value="<?php echo s($usuario->apellido); ?>"
        />
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="telefono">Teléfono</label>
        <input 
            type="tel"
            id="telefono"
            name="telefono"
            class="formulario__input"
            placeholder="Tu Teléfono"
            value="<?php echo s($usuario->telefono); ?>"
        />
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="email">E-mail</label>
        <input 
            type="email"
            id="email"
            name="email"
            class="formulario__input"
            placeholder="Tu E-mail"
            value="<?php echo s($usuario->email); ?>"
            disabled
        />
    </div>
</fieldset>
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Cambiar Contraseña</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="password_actual">Password Actual</label>
        <input 
            type="password"
            id="password_actual"
            name="password_actual"
            class="formulario__input"
            placeholder="Tu Password Actual"
        />
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="password_nuevo">Nuevo Password</label>
        <input 
            type="password"
            id="password_nuevo"
            name="password_nuevo"
            class="formulario__input"
            placeholder="Tu Password Nuevo"
        />
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="password2">Repetir Password Nuevo</label>
        <input 
            type="password"
            id="password2"
            name="password2"
            class="formulario__input"
            placeholder="Repite tu Password"
        />
    </div>
</fieldset>