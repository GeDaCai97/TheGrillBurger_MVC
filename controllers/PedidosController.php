<?php

namespace Controllers;

use MVC\Router;
use Model\Extra;
use Model\Usuario;
use Model\Articulo;
use Model\Categoria;
use Model\DetallePedido;
use Model\Domicilio;
use Model\Pedido;

class PedidosController {
    public static function crearPedido(Router $router)
    {
        if(!is_auth()) {
            header('Location: /');
            return;
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
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()) {
                header('Location: /');
                return;
            }
            $articulos = explode(',', $_POST['Articulos_id']);
            $cantidad = explode(',', $_POST['cantidad']);
            if(empty($articulos)) {
                echo json_encode(['resultado' => false]);
                return;
            }
            //Comprobar si el usuario tiene domicilio
            
            if($_POST['domicilio'] === '2') {
                $domicilio = Domicilio::where('usuario_id', $_SESSION['id']);
                if(!$domicilio) {
                    echo json_encode(['resultado' => false, 'mensaje' => 'No tienes un domicilio registrado', 'domicilio' => true]);
                    return;
                }
            }

            //Comprobar si el usuario tiene pedidos y bloquearlo a 1 pedido por usuario
            // $pedido = Pedido::where('Usuarios_id', $_SESSION['id']);
            // if($pedido) {
            //     echo json_encode(['resultado' => false, 'mensaje' => 'Ya cuentas con un pedido en curso']);
            //     return;
            // }

            $pedido = new Pedido();
            $pedido->Usuarios_id = $_SESSION['id'];
            $pedido->hora = $_POST['hora'];
            $pedido->fecha = date('Y-m-d');
            $pedido->comentario = $_POST['comentario'];
            $pedido->domicilio = $_POST['domicilio'];
            $pedido->precio_total = $_POST['precio_total'];
            $alertas = $pedido->validar();
            // $i = 0;
            // debuguear($articulos[$i]);
            if(empty($alertas)) {
                $resultado = $pedido->guardar();
                if($resultado) {
                    $pedido = Pedido::whereArrayUnique(['Usuarios_id' => $_SESSION['id'], 'fecha' => $pedido->fecha, 'hora' => $pedido->hora]);
                    if($pedido) {
                        $i = 0;
                        $detallepedido = new DetallePedido();
                        foreach($articulos as $articulo) {
                            $detallepedido->Pedidos_id = $pedido->id;
                            $detallepedido->Articulos_id = $articulos[$i];
                            //$detallepedido->Combos_id = null;
                            $detallepedido->cantidad = $cantidad[$i];
                            //$detallepedido->ArticulosExtras_id = $extras[$i] ?? null;
                            $resultado = $detallepedido->guardar();
                            $i++;
                        }
                        if($resultado) {
                            echo json_encode(['resultado' => $resultado]);
                        } else {
                            $pedido->eliminar();
                            echo json_encode(['resultado' => $resultado]);
                        }
                        return;
                    }
                }
            }

        }
        //
        //debuguear(date('h:i:s a'));
        
        $router->render('private/pedido/crear', [
            'titulo' => 'Crear Pedido',
            'categorias' => $categorias
        ]);
    }
}