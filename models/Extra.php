<?php
namespace Model;

class Extra extends ActiveRecord {
    protected static $tabla = 'extras';
    protected static $columnasDB = ['id', 'nombre', 'precio', 'Categorias_id'];

    public $id;
    public $nombre;
    public $precio;
    public $Categorias_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->Categorias_id = $args['Categorias_id'] ?? '';
    }
    public function validar()
    {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Extra es Obligatorio';
        }
        if(strlen($this->nombre) > 45) {
            self::$alertas['error'][] = 'El Nombre del Extra no puede tener más de 45 carácteres';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'El Precio del Extra es Obligatorio';
        }
        if(!$this->Categorias_id) {
            self::$alertas['error'][] = 'La Categoría del Extra es Obligatorio';
        }
    }

}