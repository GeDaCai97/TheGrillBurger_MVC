<?php
namespace Controllers;

use Model\Articulo;
use Model\DetallePedido;
use Model\Pedido;
use Model\Usuario;
use MVC\Router;

class DashboardController {
    public static function index(Router $router)
    { 
        if(!is_adminAdv()) {
            header('Location: /');
            return;
        }
        $pedidos = Pedido::all('ASC');
        if($pedidos) {
            foreach($pedidos as $pedido) {
                $pedido->usuario = Usuario::find($pedido->Usuarios_id);
                $pedido->detalles = DetallePedido::belongsTo('Pedidos_id', $pedido->id);
                foreach($pedido->detalles as $articulo) {
                    $articulo->articulo = Articulo::find($articulo->Articulos_id);
                }
            }
        }
        $router->render('admin/dashboard/index', [
            'titulo' => 'Pedidos',
            'pedidos' => $pedidos
        ]);
    }
}