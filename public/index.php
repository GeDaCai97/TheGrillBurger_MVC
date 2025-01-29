<?php
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\APIController;
use Controllers\IndexController;
use Controllers\LoginController;
use Controllers\CombosController;
use Controllers\PedidosController;
use Controllers\ArticulosController;
use Controllers\DashboardController;
use Controllers\CategoriasController;
use Controllers\ExtrasController;
use Controllers\RegistradosController;

$router = new Router();


//Index
$router->get('/', [IndexController::class, 'index']);
$router->get('/menu', [IndexController::class, 'menu']);
$router->get('/nosotros', [IndexController::class, 'nosotros']);
//Index -Profile
$router->get('/perfil', [IndexController::class, 'perfil']);
$router->post('/perfil', [IndexController::class, 'perfil']);
$router->post('/perfil/update', [IndexController::class, 'update']);

$router->get('/perfil/domicilio', [IndexController::class, 'domicilio']);
$router->post('/perfil/domicilio', [IndexController::class, 'domicilio']);


//Login -IniciarSesión
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
// -Registrar
$router->get('/registrar', [LoginController::class, 'registrar']);
$router->post('/registrar', [LoginController::class, 'registrar']);
// -RecuperarCuenta
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);
// -ConfirmarCuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);
//LogOut
$router->post('/logout', [LoginController::class, 'logout']);


//PedidosController -Cliente
$router->get('/crear-pedido', [PedidosController::class, 'crearPedido']);
$router->post('/crear-pedido', [PedidosController::class, 'crearPedido']);
// -Trabajador
// $router->get('/crear-comanda', [PedidosController::class, 'crearComanda']);
// $router->post('/crear-comanda', [PedidosController::class, 'crearComanda']);

//Administrador
$router->get('/administrador/dashboard', [DashboardController::class, 'index']);

//Administrador / Menu CRUD
$router->get('/administrador/articulos', [ArticulosController::class, 'index']);
$router->get('/administrador/articulos/crear', [ArticulosController::class, 'crear']);
$router->post('/administrador/articulos/crear', [ArticulosController::class, 'crear']);
$router->post('/administrador/articulos/eliminar', [ArticulosController::class, 'eliminar']);
$router->get('/administrador/articulos/editar', [ArticulosController::class, 'editar']);
$router->post('/administrador/articulos/editar', [ArticulosController::class, 'editar']);


//Administrador / Categorias CRUD
//Categorias
$router->get('/administrador/categorias', [CategoriasController::class, 'index']);
$router->get('/administrador/categorias/crear', [CategoriasController::class, 'crear']);
$router->post('/administrador/categorias/crear', [CategoriasController::class, 'crear']);
$router->post('/administrador/categorias/eliminar', [CategoriasController::class, 'eliminar']);
$router->get('/administrador/categorias/editar', [CategoriasController::class, 'editar']);
$router->post('/administrador/categorias/editar', [CategoriasController::class, 'editar']);

//Administrador / Registrados CRUD
$router->get('/administrador/registrados', [RegistradosController::class, 'index']);
$router->post('/administrador/registrados/bloquear', [RegistradosController::class, 'bloquear']);
$router->post('/administrador/registrados/eliminar', [RegistradosController::class, 'eliminar']);

//Administrador / Combos CRUD
$router->get('/administrador/combos', [CombosController::class, 'index']);
$router->get('/administrador/combos/crear', [CombosController::class, 'crear']);
$router->post('/administrador/combos/crear', [CombosController::class, 'crear']);
$router->post('/administrador/combos/eliminar', [CombosController::class, 'eliminar']);
$router->get('/administrador/combos/editar', [CombosController::class, 'editar']);
$router->post('/administrador/combos/editar', [CombosController::class, 'editar']);

//Administrador / Combos / CombosArticulos
$router->get('/administrador/combos/combosarticulos', [CombosController::class, 'combosarticulos']);

//Administrador / Extras CRUD
$router->get('/administrador/extras', [ExtrasController::class, 'index']);
$router->get('/administrador/extras/crear', [ExtrasController::class, 'crear']);
$router->post('/administrador/extras/crear', [ExtrasController::class, 'crear']);
$router->get('/administrador/extras/editar', [ExtrasController::class, 'editar']);
$router->post('/administrador/extras/editar', [ExtrasController::class, 'editar']);
$router->post('/administrador/extras/eliminar', [ExtrasController::class, 'eliminar']);



//APIController
$router->get('/api/articulos', [APIController::class, 'articulos']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();