<?php

namespace Controllers;

use MVC\Router;
use Model\Articulo;
use Model\Categoria;
use Classes\Paginacion;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ArticulosController {
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
            header('Location: /administrador/articulos?page=1');
        }
        $registros_por_pagina = 6;
        $total = Articulo::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        // if($paginacion->total_paginas() < $pagina_actual) {
        //     header('Location: /administrador/articulos?page=1');
        // }
        $articulos = Articulo::paginar($registros_por_pagina, $paginacion->offset());
            foreach($articulos as $articulo) {
                if($articulo->Categorias_id) {
                    $articulo->Categorias_id = Categoria::find($articulo->Categorias_id);
                }
            }
        $router->render('admin/articulos/index', [
            'titulo' => 'Artículos',
            'mensaje' => $mensaje,
            'articulos' => $articulos,
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
        $categorias = Categoria::all();
        $articulo = new Articulo;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/articulos';
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }
                $nombre_imagen = md5(uniqid(rand(), true));
                $manager = new ImageManager(new Driver());
                $image_png = $manager->read($_FILES['imagen']['tmp_name']);
                $image_png->scale(800, 800);
                $image_webp = $manager->read($_FILES['imagen']['tmp_name']);
                $image_webp->scale(800, 800);
                $image_avif = $manager->read($_FILES['imagen']['tmp_name']);
                $image_avif->scale(800, 800);

                $_POST['imagen'] = $nombre_imagen;
            }
            $articulo->sincronizar($_POST);
            $alertas = $articulo->validar();
            if(empty($alertas)) {
                if(!empty($articulo->imagen)) {
                    $image_png->toPng()->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $image_webp->toWebp()->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                    $image_avif->toAvif()->save($carpeta_imagenes . '/' . $nombre_imagen . ".avif");
                }
                $resultado = $articulo->guardar();
                if($resultado) {
                    header('Location: /administrador/articulos?page=1&mensaje=1');
                }
            }

        }
        $router->render('admin/articulos/crear', [
            'titulo' => 'Crear Artículo',
            'categorias' => $categorias,
            'alertas' => $alertas
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
            header('Location: /administrador/articulos');
        }
        $articulo = Articulo::find($id);
        $categorias = Categoria::all();
        if(!$articulo) {
            header('Location: /administrador/articulos');
        }
        $articulo->imagen_actual = $articulo->imagen;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_adminAdv()) {
                header('Location: /');
                return;
            }
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/articulos';
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }
                $nombre_imagen = md5(uniqid(rand(), true));
                $manager = new ImageManager(new Driver());
                $image_png = $manager->read($_FILES['imagen']['tmp_name']);
                $image_png->scale(800, 800);
                $image_webp = $manager->read($_FILES['imagen']['tmp_name']);
                $image_webp->scale(800, 800);
                $image_avif = $manager->read($_FILES['imagen']['tmp_name']);
                $image_avif->scale(800, 800);

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $articulo->imagen_actual;
            }
            $articulo->sincronizar($_POST);
            $alertas = $articulo->validar();
            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $image_png->toPng()->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $image_webp->toWebp()->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                    $image_avif->toAvif()->save($carpeta_imagenes . '/' . $nombre_imagen . ".avif");
                }
                $resultado =  $articulo->guardar();
                if($resultado) {
                    header('Location: /administrador/articulos?page=1&mensaje=2');
                }
            }
        }
        $router->render('admin/articulos/editar', [
            'titulo' => 'Editar Artículo',
            'alertas' => $alertas,
            'articulo' => $articulo,
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
            $articulo = Articulo::find($id);
            if(!isset($articulo)) {
                header('Location: /administrador/articulos');
            }
            $resultado = $articulo->eliminar();
            if($resultado) {
                header('Location: /administrador/articulos?page=1&mensaje=3');
            }
        }
    }
}