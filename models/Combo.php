<?php
namespace Model;

class Combo extends ActiveRecord {
    protected static $tabla = 'combos';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'precio_combo'];

    public $id;
    public $nombre;
    public $descripcion;
    public $precio_combo;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio_combo = $args['precio_combo'] ?? '';
    }
    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es Obligatorio';
        }
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'La descripción es Obligatorio';
        }
        if(!$this->precio_combo) {
            self::$alertas['error'][] = 'El precio del Combo es Obligatorio';
        }
        return self::$alertas;
    }
}