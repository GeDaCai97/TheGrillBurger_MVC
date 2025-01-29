<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor-boton">
    <a href="/administrador/extras/crear" class="dashboard__boton">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Extra
    </a>
</div>
<?php if($mensaje) { ?>
    <div class="alerta alerta__exito"><?php echo $mensaje; ?></div>
<?php } ?>
<div class="dashboard__contenedor">
    <?php if(!empty($extras)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Extra</th>
                    <th scope="col" class="table__th">Precio</th>
                    <th scope="col" class="table__th">Categoría</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($extras as $extra) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $extra->nombre; ?>
                        </td>
                        <td class="table__td">
                            $<?php echo $extra->precio; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $extra->Categorias_id->nombre; ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/administrador/extras/editar?id=<?php echo $extra->id; ?>">
                                <i class="fa-solid fa-pencil"></i>
                                Editar
                            </a>
                            <form method="POST" action="/administrador/extras/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $extra->id; ?>">
                                <button class="table__accion table__accion--eliminar" type="submit">
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
        <p class="text-center">No hay Extras Aún</p>
    <?php } ?>
</div>
<?php 
echo $paginacion;
?>