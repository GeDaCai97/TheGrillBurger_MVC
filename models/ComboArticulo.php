<?php
namespace Model;

class ComboArticulo extends ActiveRecord {
    protected static $tabla = 'combosarticulos';
    protected static $columnasDB = ['id', 'Combos_id', 'Articulos_id', 'cantidad'];
    public $id;
    public $Combos_id;
    public $Articulos_id;
    public $cantidad;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Combos_id = $args['Combos_id'] ?? null;
        $this->Articulos_id = $args['Articulos_id'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
    }
}