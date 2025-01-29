<?php
namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use MVC\Router;

class CategoriasController {
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
            header('Location: /administrador/categorias?page=1');
        }
        $registros_por_pagina = 5;
        $total = Categoria::total();
        
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        // if($paginacion->total_paginas() < $pagina_actual) {
        //     header('Location: /administrador/categorias?page=1');
        // }
        
        $categorias = Categoria::paginar($registros_por_pagina, $paginacion->offset());
        

        $router->render('admin/categorias/index', [
            'titulo' => 'Categorías',
            'mensaje' => $mensaje,
            'categorias' => $categorias,
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
        $categoria = new Categoria;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            $categoria->sincronizar($_POST);
            $alertas = $categoria->validar();
            if(empty($alertas)) {
                $resultado = $categoria->guardar();
                if($resultado) {
                    header('Location: /administrador/categorias?page=1&mensaje=1');
                }
            }

        }
        $alertas = Categoria::getAlertas();
        $router->render('admin/categorias/crear', [
            'titulo' => 'Crear Categoría',
            'alertas' => $alertas,
            'categoria' => $categoria
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
            $categoria = Categoria::find($id);
            if(!isset($categoria)) {
                header('Location: /administrador/categorias');
            }
            $resultado = $categoria->eliminar();
            if($resultado) {
                header('Location: /administrador/categorias?page=1&mensaje=3');
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
            header('Location: /administrador/categorias');
        }
        $categoria = Categoria::find($id);
        if(!$categoria) {
            header('Location: /administrador/categorias');
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            $categoria->sincronizar($_POST);
            $alertas = $categoria->validar();
            if(empty($alertas)) {
                $resultado = $categoria->guardar();
                if($resultado) {
                    header('Location: /administrador/categorias?page=1&mensaje=2');
                }
            }
        }
        
        $router->render('admin/categorias/editar', [
            'titulo' => 'Editar Categoría',
            'alertas' => $alertas,
            'categoria' => $categoria
        ]);
    }
}