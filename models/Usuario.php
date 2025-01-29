<?php
namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'userLevel', 'confirmado', 'token', 'bloqueado'];
    
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $password_actual;
    public $password_nuevo;
    public $password2;
    public $telefono;
    public $userLevel;
    public $confirmado;
    public $token;
    public $bloqueado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->userLevel = $args['userLevel'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->bloqueado = $args['bloqueado'] ?? 0;
    }


    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Usuario es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido del Usuario es Obligatorio';
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'El Telefono del Usuario es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El Email no es valido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password del Usuario es Obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Los Password son diferentes';
        }
        return self::$alertas;
    }
    public function validarActualizacion() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Usuario es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido del Usuario es Obligatorio';
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'El Telefono del Usuario es Obligatorio';
        }
        return self::$alertas;
    }
    public function validarActPassword() {

    }
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El Email no es valido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password del Usuario es Obligatorio';
        }
        return self::$alertas;
    }
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password);
    }
    public function crearToken() {
        $this->token = uniqid();
    }
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El Email no es valido';
        }
        return self::$alertas;
    }
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password del Usuario es Obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }
    public function validarUserLevel() {
        switch($this->userLevel) {
            case 0:
                header('Location: /');
                break;
            case 1:
                header('Location: /');
                break;
            case 2:
                header('Location: /administrador/dashboard');
                break;
            case 3:
                header('Location: /administrador/dashboard');
                break;
            default:
                header('Location: /');
                break;
        }
    }
    public function altBloqueo() {
        if($this->bloqueado === '0') {
            $this->bloqueado = '1';
        } else {
            $this->bloqueado = '0';
        }
    }
    public function isAdmin() {
        if($this->userLevel >= "2") {
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }
    public function nuevo_password() {
        if(!$this->password_nuevo) {
            self::$alertas['error'][] = 'El Password Nuevo no puede estar vacío';
        }
        if(strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = 'El Password Nuevo debe contener al menos 6 caracteres';
        }
        if($this->password_nuevo !== $this->password2) {
            self::$alertas['error'][] = 'Los Password son diferentes';
        }
        return self::$alertas;
    }
    
}