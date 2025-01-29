<?php
namespace Controllers;

use MVC\Router;
use Model\Combo;
use Model\Extra;
use Model\Articulo;
use Model\Categoria;
use Classes\Paginacion;

class CombosController {
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
            header('Location: /administrador/combos?page=1');
        }
        $registros_por_pagina = 6;
        $total = Combo::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        // if($paginacion->total_paginas() < $pagina_actual) {
        //     header('Location: /administrador/categorias?page=1');
        // }
        $combos = Combo::paginar($registros_por_pagina, $paginacion->offset());
        $router->render('admin/combos/index', [
            'titulo' => 'Combos',
            'mensaje' => $mensaje,
            'combos' => $combos,
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
        $combo = new Combo();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            $combo->sincronizar($_POST);
            $alertas = $combo->validar();
            if(empty($alertas)) {
                $resultado = $combo->guardar();
                if($resultado) {
                    header('Location: /administrador/combos?page=1&mensaje=1');
                }
            }
        }
        $alertas = Combo::getAlertas();
        $router->render('admin/combos/crear', [
            'titulo' => 'Crear Combo',
            'alertas' => $alertas
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
            $combo = Combo::find($id);
            if(!isset($combo)) {
                header('Location: /administrador/combos');
            }
            $resultado = $combo->eliminar();
            if($resultado) {
                header('Location: /administrador/combos?page=1&mensaje=3');
            }
        }
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
            header('Location: /administrador/combos');
        }
        $combo = Combo::find($id);
        if(!$combo) {
            header('Location: /administrador/combos');
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            $combo->sincronizar($_POST);
            $alertas = $combo->validar();
            if(empty($alertas)) {
                $resultado = $combo->guardar();
                if($resultado) {
                    header('Location: /administrador/combos?page=1&mensaje=2');
                }
            }
        }

        $router->render('admin/combos/editar', [
            'titulo' => 'Editar Combo',
            'alertas' => $alertas,
            'combo' => $combo
        ]);
    }
    public static function combosarticulos(Router $router)
    {
        if(!is_adminAdv()) {
            header('Location: /');
            return;
        }
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!$id) {
            header('Location: /administrador/combos');
        }
        $combo = Combo::find($id);
        if(!$combo) {
            header('Location: /administrador/combos');
        }
        $categorias = Categoria::all('ASC');
        if($categorias) {
            foreach($categorias as $categoria) {
                $categoria->articulos = Articulo::belongsTo('Categorias_id', $categoria->id);
                foreach($categoria->articulos as $articulo) {
                    $articulo->extras = Extra::belongsTo('Categorias_id', $articulo->Categorias_id);
                }
            }
        }
        $router->render('admin/combos/combosarticulos', [
            'titulo' => 'Combos Articulos',
            'categorias' => $categorias,
            'Combos_id' => $id
        ]);
    }
}