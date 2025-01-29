<?php
namespace Model;

class ArticuloExtra extends ActiveRecord {
    protected static $tabla = 'articulosextras';
    protected static $columnasDB = ['id', 'Extras_id', 'Articulos_id'];

    public $id;
    public $Extras_id;
    public $Articulos_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Extras_id = $args['Extras_id'] ?? '';
        $this->Articulos_id = $args['Articulos_id'] ?? '';
    }
}