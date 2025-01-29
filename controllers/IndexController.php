<?php
namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Articulo;
use Model\Categoria;
use Model\Domicilio;

class IndexController {
    public static function index(Router $router) 
    {
        
        $router->render('index/index', [
            'titulo' => 'Inicio'
        ]);
    }
    public static function perfil(Router $router)
    {
        if(!is_auth()) {
            header('Location: /');
            return;
        }
        $id = $_SESSION['id'];
        $usuario = Usuario::find($id);
        $domicilio = Domicilio::where('usuario_id', $id);
        if(!$domicilio) {
            $domicilio = null;
        }

        $alertas = [];
        //trasladar a update
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()) {
                header('Location: /');
                return;
            }
            if($_POST['email']) {
                unset($_POST['email']);
            }
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarActualizacion();
            if(empty($alertas)) {
                if($usuario->password_actual) {
                    $alertas = $usuario->nuevo_password();
                    if(empty($alertas)) {
                        $resultado = $usuario->comprobar_password();
                        if($resultado) {
                            $usuario->password = $usuario->password_nuevo;
                            unset($usuario->password_actual);
                            unset($usuario->password_nuevo);
                            unset($usuario->password2);
                            $usuario->hashPassword();
                            $resultado = $usuario->guardar();
                            if($resultado) {
                                $_SESSION['nombre'] = $usuario->nombre;
                                $_SESSION['telefono'] = $usuario->telefono;
                                Usuario::setAlerta('exito', 'Guardado Correctamente');
                            }
                        } else {
                            Usuario::setAlerta('error', 'Password Incorrecto');
                        }
                    }
                } else {
                    $resultado = $usuario->guardar();
                    if($resultado) {
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['telefono'] = $usuario->telefono;
                        Usuario::setAlerta('exito', 'Guardado Correctamente');
                    }
                }
            }
        } //end POST
        $alertas = Usuario::getAlertas();
        $router->render('private/perfil/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas,
            'domicilio' => $domicilio
        ]);
    }
    public static function domicilio(Router $router) 
    {
        if(!is_auth()) {
            header('Location: /');
            return;
        }
        $alertas = [];
        $id = $_SESSION['id'];
        $domicilio = Domicilio::where('usuario_id', $id);
        if(!$domicilio) {
            $domicilio = new Domicilio;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()) {
                header('Location: /');
                return;
            }
            $domicilio->sincronizar($_POST);
            $alertas = $domicilio->validar();
            if(empty($alertas)) {
                $domicilio->usuario_id = $id;
                $resultado = $domicilio->guardar();
                if($resultado) {
                    header('Location: /perfil');
                }
            }
        }
        
        $alertas = Domicilio::getAlertas();
        $router->render('private/perfil/domicilio', [
            'titulo' => 'Domicilio',
            'alertas' => $alertas,
            'domicilio' => $domicilio
        ]);
    }
    public static function menu(Router $router)
    {
        $categorias = Categoria::all('ASC');
        if($categorias) {
            foreach($categorias as $categoria) {
                $categoria->articulos = Articulo::belongsTo('Categorias_id', $categoria->id);
            }
        }
        $router->render('index/menu', [
            'titulo' => 'Nuestro Menú',
            'categorias' => $categorias
        ]);
    }
    public static function nosotros(Router $router) 
    {
        $router->render('index/nosotros', [
            'titulo' => 'Sobre Nosotros'
        ]);
    }
}