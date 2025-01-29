<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor-boton">
    <a href="/administrador/combos/crear" class="dashboard__boton">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Combo
    </a>
</div>
<?php if($mensaje) { ?>
    <div class="alerta alerta__exito"><?php echo $mensaje; ?></div>
<?php } ?>
<div class="dashboard__contenedor">
    <?php if(!empty($combos)) { ?>
        <div class="combo__grid">
        <?php foreach($combos as $combo) { ?>
            <div class="combo">
                <div class="combo__contenedor">
                    <div class="combo__nombre">
                        <h3 class="combo__titulo"><?php echo $combo->nombre; ?></h3>
                    </div>
                    <div class="combo__descripcion">
                        <p class="combo__texto"><?php echo $combo->descripcion; ?></p>
                    </div>
                    <div class="combo__precio">
                        <p class="combo__precio-texto"><span class="combo__span">$</span><?php echo $combo->precio_combo; ?></p>
                    </div>
                </div>
                <div class="combo__acciones">
                    <a class="combo__accion combo__accion--editar" href="/administrador/combos/editar?id=<?php echo $combo->id; ?>">
                        <i class="fa-solid fa-pencil"></i>
                        Editar
                    </a>
                    <a class="combo__accion combo__accion--contenido" href="/administrador/combos/combosarticulos?id=<?php echo $combo->id; ?>">
                        <i class="fa-solid fa-pencil"></i>
                        Editar Contenido
                    </a>
                    <form method="POST" action="/administrador/combos/eliminar" class="combo__formulario">
                        <input type="hidden" name="id" value="<?php echo $combo->id; ?>">
                        <button class="combo__accion combo__accion--eliminar" type="submit">
                            <i class="fa-solid fa-circle-xmark"></i>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        <?php } ?>
        </div>
    <?php } else { ?>
        <p class="text-center">No hay Combos Aún</p>
    <?php } ?>
</div>
<?php 
echo $paginacion;
?>