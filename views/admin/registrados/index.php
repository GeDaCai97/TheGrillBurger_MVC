<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<?php if($mensaje) { ?>
    <div class="alerta alerta__exito"><?php echo $mensaje; ?></div>
<?php } ?>
<div class="dashboard__contenedor">
<?php if(!empty($registrados)) { ?>
    <table class="table">
        <thead class="table__thead">
            <tr>
                <th scope="col" class="table__th">Registrados</th>
                <th scope="col" class="table__th">Email</th>
                <th scope="col" class="table__th">Teléfono</th>
                <th scope="col" class="table__th">Confirmado</th>
                <th scope="col" class="table__th">Bloqueado</th>
                <th scope="col" class="table__th">Administrador</th>
                <th scope="col" class="table__th"></th>
            </tr>
        </thead>
        <tbody class="table__tbody">
            <?php foreach($registrados as $registrado) { ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?php echo $registrado->nombre . ' ' . $registrado->apellido; ?>
                    </td>
                    <td class="table__td">
                        <?php echo $registrado->email; ?>
                    </td>
                    <td class="table__td">
                        <?php echo $registrado->telefono; ?>
                    </td>
                    <td class="table__td">
                        <?php echo ($registrado->confirmado === '1') ? 'Si' : 'No'; ?>
                    </td>
                    <td class="table__td">
                        <?php echo ($registrado->bloqueado === '1') ? 'Si' : 'No'; ?>
                    </td>
                    <td class="table__td">
                        <?php echo ($registrado->userLevel >= "2") ? 'Administrador' : 'Usuario'; ?>
                    </td>
                    <td class="table__td--acciones">
                        <form method="POST" action="/administrador/registrados/bloquear" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo $registrado->id; ?>">
                            <button id="registrado__bloquear" class="table__accion table__accion--bloquear<?php echo ($registrado->userLevel >= "2") ? '-deshabilitado' : ''; ?>" type="submit" <?php echo ($registrado->userLevel >= "2") ? 'disabled' : ''; ?> >
                                <i class="fa-solid fa-pencil"></i>
                                    <?php echo ($registrado->bloqueado) ? 'Desbloquear' : 'Bloquear' ?>
                            </button>
                        </form>

                        <form method="POST" action="/administrador/registrados/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo $registrado->id; ?>">
                            <button data-id="<?php echo $registrado->id; ?>" id="registrado__eliminar" class="table__accion table__accion--eliminar" type="submit">
                                <i class="fa-solid fa-circle-xmark"></i>
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p class="text-center">No hay Registrados Aún</p>
<?php } ?>
</div>

<?php 
echo $paginacion;
?>