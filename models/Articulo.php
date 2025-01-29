<?php
namespace Model;

class Articulo extends ActiveRecord {
    protected static $tabla = 'articulos';
    protected static $columnasDB = ['id', 'nombre', 'precio_articulo', 'imagen', 'descripcion', 'Categorias_id'];

    public $id;
    public $nombre;
    public $precio_articulo;
    public $imagen;
    public $descripcion;
    public $Categorias_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio_articulo = $args['precio_articulo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->Categorias_id = $args['Categorias_id'] ?? '';
    }
    public function validar() 
    {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Artículo es Obligatorio';
        }
        if(!$this->precio_articulo) {
            self::$alertas['error'][] = 'El Precio del Artículo es Obligatorio';
        }
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'La Descripción del Artículo es Obligatorio';
        }
        if(strlen($this->descripcion) >= 200) {
            self::$alertas['error'][] = 'La Descripción del Artículo no puede ser mayor a 200 caracteres';
        }
        if(!$this->Categorias_id) {
            self::$alertas['error'][] = 'La Categoria del Artículo es Obligatorio';
        }
        return self::$alertas;
    }
}