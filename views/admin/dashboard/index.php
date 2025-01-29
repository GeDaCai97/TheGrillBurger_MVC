<div class="dashboard__contenedor-boton--reload">
    <a href="/administrador/dashboard" class="dashboard__boton--reload">
        <i class="fa-solid fa-rotate-right"></i>
    </a>
</div>
<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor dashboard__contenedor--pedidos">
    <?php if(!empty($pedidos)) { ?>
        <div class="pedido__grid">
        <?php foreach($pedidos as $pedido) { ?>
            <div class="pedido">
                <div class="pedido__contenedor">
                    <div class="pedido__nombre">
                        <h3 class="pedido__titulo">Pedido #<?php echo $pedido->id; ?></h3>
                    </div>
                    <div class="pedido__articulo">
                        <p class="pedido__articulo-texto">Artículo</p>
                        <p class="pedido__articulo-texto">Cantidad</p>
                    </div>
                    <?php foreach($pedido->detalles as $detalle) { ?>
                        <div class="pedido__articulo">
                            <p class="pedido__articulo-texto"><?php echo $detalle->articulo->nombre; ?></p>
                            <p class="pedido__articulo-texto--cantidad"><?php echo $detalle->cantidad; ?></p>
                        </div>
                    <?php } ?>
                    <div class="pedido__precio">
                        <p class="pedido__precio-texto">Valor del pedido: $<span class="pedido__span"><?php echo $pedido->precio_total; ?></span></p>
                    </div>
                    <div class="pedido__descripcion">
                        <p class="pedido__texto">Estatus: <span class="pedido__span"><?php echo ''; ?></span></p>
                        <p class="pedido__texto">Cliente: <span class="pedido__span"><?php echo $pedido->usuario->nombre; ?></span></p>
                        <p class="pedido__texto">Fecha de creación: <span class="pedido__span"><?php echo $pedido->fecha; ?></span></p>
                        <p class="pedido__texto">Hora de creación: <span class="pedido__span"><?php echo $pedido->hora; ?></span></p>
                    </div>
                </div>
                <div class="pedido__acciones">
                    <form method="POST" action="/administrador/dashboard/eliminar" class="combo__formulario">
                        <input type="hidden" name="id" value="<?php echo $pedido->id; ?>">
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
        <p class="text-center">No hay Pedidos Aún</p>
    <?php } ?>
</div>