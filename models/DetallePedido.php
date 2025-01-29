<?php

namespace Model;

class DetallePedido extends ActiveRecord {
    protected static $tabla = 'detallespedidos';
    protected static $columnasDB = ['id', 'Pedidos_id', 'Articulos_id', 'cantidad'];

    public $id;
    public $Pedidos_id;
    public $Articulos_id;
    public $Combos_id;
    public $cantidad;
    public $ArticulosExtras_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Pedidos_id = $args['Pedidos_id'] ?? '';
        $this->Articulos_id = $args['Articulos_id'] ?? '';
        //$this->Combos_id = $args['Combos_id'] ?? null;
        $this->cantidad = $args['cantidad'] ?? '';
        //$this->ArticulosExtras_id = $args['ArticulosExtras_id'] ?? '';
    }
}