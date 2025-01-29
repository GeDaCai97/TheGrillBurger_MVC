<?php
namespace Controllers;

use MVC\Router;
use Model\Extra;
use Model\Categoria;
use Classes\Paginacion;

class ExtrasController {
    public static function index(Router $router)
    {
        if(!is_adminAdv()) {
            header('Location: /');
            return;
        }
        $resultado = $_GET['mensaje'] ?? null;
        if($resultado) {
            $mensaje = mostrarNotificacion($resultado);
        }
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /administrador/extras?page=1');
        }
        $registros_por_pagina = 5;
        $total = Extra::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        $extras = Extra::paginar($registros_por_pagina, $paginacion->offset());
        foreach($extras as $extra) {
            if($extra->Categorias_id) {
                $extra->Categorias_id = Categoria::find($extra->Categorias_id);
            }
        }
        $router->render('admin/extras/index', [
            'titulo' => 'Extras',
            'mensaje' => $mensaje,
            'extras' => $extras,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
    public static function crear(Router $router)
    {
        if(!is_adminAdv()) {
            header('Location: /');
            return;
        }
        $alertas = [];
        $categorias = Categoria::all('ASC');
        $extra = new Extra;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            $extra->sincronizar($_POST);
            $alertas = $extra->validar();
            if(empty($alertas)) {
                $resultado = $extra->guardar();
                if($resultado) {
                    header('Location: /administrador/extras?page=1&mensaje=1');
                }
            }
        }
        $alertas = Extra::getAlertas();
        $router->render('admin/extras/crear', [
            'titulo' => 'Crear Extra',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'extra' => 'extra'
        ]);
    }
    public static function editar(Router $router) 
    {
        if(!is_adminAdv()) {
            header('Location: /');
            return;
        }
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!$id) {
            header('Location: /administrador/extras');
        }
        $extra = Extra::find($id);
        $categorias = Categoria::all('ASC');
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            $extra->sincronizar($_POST);
            $alertas = $extra->validar();
            if(empty($alertas)) {
                $resultado = $extra->guardar();
                if($resultado) {
                    header('Location: /administrador/extras?page=1&mensaje=2');
                }
            }
        }
        $router->render('admin/extras/editar', [
            'titulo' => 'Editar Extra',
            'alertas' => $alertas,
            'extra' => $extra,
            'categorias' => $categorias
        ]);
    }
    public static function eliminar()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            $id = $_POST['id'];
            $extra = Extra::find($id);
            if(!isset($extra)) {
                header('Location: /administrador/extras');
            }
            $resultado = $extra->eliminar();
            if($resultado) {
                header('Location: /administrador/extras?page=1&mensaje=3');
            }
        }
    }
}