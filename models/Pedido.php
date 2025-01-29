<?php

namespace Model;

class Pedido extends ActiveRecord {
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'Usuarios_id', 'hora', 'fecha', 'comentario', 'domicilio', 'precio_total'];

    public $id;
    public $Usuarios_id;
    public $hora;
    public $fecha;
    public $comentario;
    public $domicilio;
    public $precio_total;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Usuarios_id = $args['Usuarios_id'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->comentario = $args['comentario'] ?? '';
        $this->domicilio = $args['domicilio'] ?? '';
        $this->precio_total = $args['precio_total'] ?? '';
    }
    public function validar()
    {
        if(!$this->Usuarios_id) {
            self::$alertas['error'][] = 'El Usuario es Obligatorio';
        }
        if(!$this->hora) {
            self::$alertas['error'][] = 'La Hora es Obligatorio';
        }
        if(!$this->fecha) {
            self::$alertas['error'][] = 'La Fecha es Obligatorio';
        }
        if(!$this->domicilio) {
            self::$alertas['error'][] = 'El Domicilio es Obligatorio';
        }
        if(!$this->precio_total) {
            self::$alertas['error'][] = 'El Precio Total es Obligatorio';
        }
        return self::$alertas;
    }
}