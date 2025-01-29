<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor-boton">
    <a href="/administrador/articulos/crear" class="dashboard__boton">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Articulo
    </a>
</div>
<?php if($mensaje) { ?>
    <div class="alerta alerta__exito"><?php echo $mensaje; ?></div>
<?php } ?>

<div class="dashboard__contenedor">
    <?php if(!empty($articulos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Imagen</th>
                    <th scope="col" class="table__th">Articulos</th>
                    <th scope="col" class="table__th">Precio</th>
                    <th scope="col" class="table__th">Categoría</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($articulos as $articulo) { ?>
                    <tr class="table__tr">
                        <td class="table__td table__td--imagen">
                        <?php if($articulo->imagen) { ?>
                            <picture>
                                <source srcset="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen; ?>.avif" type="image/avif">
                                <source srcset="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen; ?>.webp" type="image/webp">
                                <img src="<?php echo $_ENV['HOST'] . '/img/articulos/' . $articulo->imagen; ?>.png" alt="Imagen Articulo">
                            </picture>
                        <?php } else { ?>
                            No hay Imagen
                        <?php } ?>
                        </td>
                        <td class="table__td">
                            <?php echo $articulo->nombre; ?>
                        </td>
                        <td class="table__td">
                            $<?php echo $articulo->precio_articulo; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $articulo->Categorias_id->nombre; ?>
                        </td>

                        <td class="table__td table__td--acciones_imagen">
                            <a class="table__accion table__accion--editar" href="/administrador/articulos/editar?id=<?php echo $articulo->id; ?>">
                                <i class="fa-solid fa-pencil"></i>
                                Editar
                            </a>
                            <form method="POST" action="/administrador/articulos/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $articulo->id; ?>">
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
        <p class="text-center">No hay Artículos Aún</p>
    <?php } ?>
    </div>
<?php 
echo $paginacion;
?>