<?php
namespace Model;

class Domicilio extends ActiveRecord {
    protected static $tabla = 'domicilios';
    protected static $columnasDB = ['id', 'calle', 'colonia', 'numexterior', 'numinterior', 'codigoPostal', 'referencias', 'usuario_id'];

    public $id;
    public $calle;
    public $colonia;
    public $numexterior;
    public $numinterior;
    public $codigoPostal;
    public $referencias;
    public $usuario_id;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->calle = $args['calle'] ?? '';
        $this->colonia = $args['colonia'] ?? '';
        $this->numexterior = $args['numexterior'] ?? '';
        $this->numinterior = $args['numinterior'] ?? '';
        $this->codigoPostal = $args['codigoPostal'] ?? '';
        $this->referencias = $args['referencias'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? '';
    }
    public function validar() {
        if(!$this->calle) {
            self::$alertas['error'][] = 'La Calle es Obligatorio';
        }
        if(!$this->colonia) {
            self::$alertas['error'][] = 'La Colonia del Usuario es Obligatorio';
        }
        if(!$this->numexterior) {
            self::$alertas['error'][] = 'El Número Exterior es Obligatorio';
        }
        if(!$this->codigoPostal) {
            self::$alertas['error'][] = 'El Código Postal es Obligatorio';
        }
        if(!$this->referencias) {
            self::$alertas['error'][] = 'Las Referencias es Obligatorio';
        }
        if(strlen($this->calle) > 60) {
            self::$alertas['error'][] = 'La calle no debe contener más de 60 caracteres';
        }
        if(strlen($this->colonia) > 30) {
            self::$alertas['error'][] = 'La colonia no debe contener más de 30 caracteres';
        }
        if(strlen($this->numexterior) > 8) {
            self::$alertas['error'][] = 'El Número exterior debe contener menos de 8 caracteres';
        }
        if(strlen($this->numinterior) > 8) {
            self::$alertas['error'][] = 'El Número interior debe contener menos de 8 caracteres';
        }
        if(strlen($this->codigoPostal) > 6) {
            self::$alertas['error'][] = 'El Código Postal debe contener menos de 6 caracteres';
        }
        if(strlen($this->referencias) > 150) {
            self::$alertas['error'][] = 'Las referencias no deben contener más de 150 caracteres';
        }

        return self::$alertas;
    }
    
}