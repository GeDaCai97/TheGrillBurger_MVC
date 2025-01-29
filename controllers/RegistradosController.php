<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Classes\Paginacion;

class RegistradosController {
    public static function index(Router $router) 
    {
        if(!is_adminAdv()) {
            header('Location: /');
            return;
        }
        $resultado = $_GET['mensaje'];
        $mensaje = mostrarNotificacion($resultado);
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /administrador/registrados?page=1');
        }
        $registros_por_pagina = 10;
        $total = Usuario::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        // if($paginacion->total_paginas() < $pagina_actual) {
        //     header('Location: /administrador/registrados?page=1');
        // }
        $registrados = Usuario::paginar($registros_por_pagina, $paginacion->offset());
        $router->render('admin/registrados/index', [
            'titulo' => 'Registrados',
            'mensaje' => $mensaje,
            'registrados' => $registrados,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
    public static function bloquear() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            $id = $_POST['id'];
            $usuario = Usuario::find($id);
            if(!isset($usuario)) {
                header('Location: /administrador/registrados');
            }
            if($usuario->isAdmin()) {
                header('Location: /administrador/registrados?page=1');
                return;
            }
            $usuario->altBloqueo();
            $resultado = $usuario->guardar();
            if($resultado) {
                header('Location: /administrador/registrados?page=1&mensaje=2');
            }
        }
    }
    public static function eliminar()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                echo json_encode([]);
                return;
            }
            $id = $_POST['id'];
            $usuario = Usuario::find($id);
            if(!isset($usuario)) {
                echo json_encode([]);
                return;
            }
            if($usuario->isAdmin()) {
                echo json_encode(['respuesta' => 'false', 'mensaje' => 'No puedes eliminar un administrador']);
                return;
            }
            $resultado = $usuario->eliminar();
            if($resultado) {
                $respuesta = [
                    'resultado' => true,
                    'mensaje' => 'Usuario Eliminado Correctamente'
                ];
            } else {
                $respuesta = [
                    'resultado' => false,
                    'mensaje' => 'Usuario No Se Pudo Eliminar',
                ];
            }
            echo json_encode($respuesta);
            //echo json_encode(['respuesta' => $_POST['id']]);
        }
    }
}