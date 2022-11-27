<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/AccesoDatos.php';

require_once './middlewares/AutentificadorJWT.php';
require_once './middlewares/checkDataMiddleware.php';
require_once './middlewares/Logger.php';
require_once './middlewares/MWAceso.php';

require_once './controllers/LoginController.php';
require_once './controllers/MesaController.php';
require_once './controllers/OrdenController.php';
require_once './controllers/UsuarioController.php';
require_once './controllers/ProductoController.php';
require_once './controllers/EncuestaController.php';

// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Usuario
$app->group(
  '/usuarios', function (RouteCollectorProxy $group) {
    $group->get('/listar/[{tipo}]', \UsuarioController::class . ':TraerTodos')->add(\MWAceso::class . ':esAdministrador');
    $group->get('/{nombre_usuario}', \UsuarioController::class . ':TraerUno')->add(\MWAceso::class . ':esAdministrador');
    $group->post('[/]', \UsuarioController::class . ':CargarUno')->add(\MWAceso::class . ':esAdministrador');
    $group->delete('/{usuarioId}', \UsuarioController::class . ':BorrarUno')->add(\MWAceso::class . ':esAdministrador');
    $group->put('/{usuarioId}', \UsuarioController::class . ':ModificarUno')->add(\MWAceso::class . ':esAdministrador');
  }
);

//Mesa
$app->group(
  '/mesas', function (RouteCollectorProxy $group) {
    $group->get('/listar/[{estado}]', \MesaController::class . ':TraerTodos')->add(\MWAceso::class . ':esAdministrador');
    $group->post('[/]', \MesaController::class . ':CargarUno')->add(\MWAceso::class . ':esAdministrador');
    $group->delete('/{id}', \MesaController::class . ':BorrarUno')->add(\MWAceso::class . ':esAdministrador');
    $group->put('/{id}', \MesaController::class . ':ModificarUno')->add(\MWAceso::class . ':esAdministrador');
  }
);

//Ordenes
$app->group(
  '/ordenes', function (RouteCollectorProxy $group) {
    $group->get('/listar/[{estado}]', \OrdenController::class . ':TraerTodos')->add(\MWAceso::class . ':esAdministrador');
    $group->get('/{codigo_mesa}/{codigo_orden}', \OrdenController::class . ':TraerDemoraPedidoCliente');
    $group->post('[/]', \OrdenController::class . ':CargarUno')->add(\MWAceso::class . ':esAdministrador');
    $group->delete('/{id}', \OrdenController::class . ':BorrarUno')->add(\MWAceso::class . ':esAdministrador');
    $group->put('/{id}', \OrdenController::class . ':ModificarUno')->add(\MWAceso::class . ':esAdministrador');
  }
);

//Productos
$app->group(
  '/productos', function (RouteCollectorProxy $group) {
    $group->get('/listar/[{estado}]', \ProductoController::class . ':TraerTodos');
    $group->post('[/]', \ProductoController::class . ':CargarUno')->add(\MWAceso::class . ':esAdministrador');
    $group->delete('/{id}', \ProductoController::class . ':BorrarUno')->add(\MWAceso::class . ':esAdministrador');
    $group->put('/{id}', \ProductoController::class . ':ModificarUno')->add(\MWAceso::class . ':esAdministrador');
  }
);

// Encuesta
$app->group(
  '/encuestas', function (RouteCollectorProxy $group) {
    $group->get('/listar[/]', \EncuestaController::class . ':TraerTodos')->add(\MWAceso::class . ':esAdministrador');
    $group->get('/{id}', \EncuestaController::class . ':TraerUno')->add(\MWAceso::class . ':esAdministrador');
    $group->post('[/]', \EncuestaController::class . ':CargarUno');
    $group->delete('/{id}', \EncuestaController::class . ':BorrarUno')->add(\MWAceso::class . ':esAdministrador');
    $group->put('/{id}', \EncuestaController::class . ':ModificarUno')->add(\MWAceso::class . ':esAdministrador');
  }
);



 //* LOGIN AREA
 $app->group('/login', function (RouteCollectorProxy $group) {
  // Take from get method
  $group->post('[/]', \LoginController::class . ':verificarUsuario'); //* It Works
  $group->get('/listar', \LoginController::class . ':TraerTodos')->add(\MWAceso::class . ':esAdministrador');
  $group->delete('/{id}', \LoginController::class . ':BorrarUno')->add(\MWAceso::class . ':esAdministrador');
  $group->put('/{id}', \LoginController::class . ':ModificarUno')->add(\MWAceso::class . ':esAdministrador');
});


//*Socios AREA
 $app->group('/socio', function (RouteCollectorProxy $group) {
  //alta de una orden completa
  $group->get('[/]', \OrdenController::class . ':TraerDemoraPedidosAdmin')->add(\MWAceso::class . ':esAdministrador'); //* It Works
  $group->get('/mesas',\MesaController::class . ':TraerTodos')->add(\MWAceso::class . ':esAdministrador');
  $group->put('/cerrar',\MesaController::class . ':CerrarMesasCobradas')->add(\MWAceso::class . ':esAdministrador');
  $group->get('/mejorComentarios',\EncuestaController::class . ':TraerMejoresComentarios')->add(\MWAceso::class . ':esAdministrador');
  $group->get('/mesa/masUsada',\MesaController::class . ':TraerMesaMasUsada')->add(\MWAceso::class . ':esAdministrador');
  $group->get('/login/generar',\LoginController::class . ':generarCsv')->add(\MWAceso::class . ':esAdministrador');
  $group->post('/login/leerCsv',\LoginController::class . ':ActualizarLoginsUsandoCsv')->add(\MWAceso::class . ':esAdministrador');
});


 //* Mozo AREA
 $app->group('/mozo', function (RouteCollectorProxy $group) {
  //alta de una orden completa
  $group->post('[/]', \OrdenController::class . ':crearOrdenCompletaMozo')->add(\MWAceso::class . ':esMozo'); //* It Works
  //opcion de agregar foto
  $group->post('/foto[/]', \OrdenController::class . ':CargarFoto')->add(\MWAceso::class . ':esMozo'); //* It Works
  $group->put('/servir', \OrdenController::class . ':getOrdenLista')->add(\MWAceso::class . ':esMozo'); //* It Works
  $group->put('/cobrar', \MesaController::class . ':CobrarMesa')->add(\MWAceso::class . ':esMozo'); //* It Works
});

//* Cervecero AREA
 $app->group('/cervecero', function (RouteCollectorProxy $group) {
  //alta de una orden completa
  $group->put('[/]', \ProductoController::class . ':TipoIniciarPreparacionPendientes')->add(\MWAceso::class . ':esCervecero'); //* It Works
  $group->put('/preparado', \ProductoController::class . ':TipoActualizarListoParaServir')->add(\MWAceso::class . ':esCervecero'); //* It Works
});
//* Cocina AREA
 $app->group('/cocinero', function (RouteCollectorProxy $group) {
  //alta de una orden completa
  $group->put('[/]', \ProductoController::class . ':TipoIniciarPreparacionPendientes')->add(\MWAceso::class . ':esCocinero'); //* It Works
  $group->put('/preparado', \ProductoController::class . ':TipoActualizarListoParaServir')->add(\MWAceso::class . ':esCocinero'); //* It Works
});
//* Bartender AREA
 $app->group('/bartender', function (RouteCollectorProxy $group) {
  //alta de una orden completa
  $group->put('[/]', \ProductoController::class . ':TipoIniciarPreparacionPendientes')->add(\MWAceso::class . ':esBartender'); //* It Works
  $group->put('/preparado', \ProductoController::class . ':TipoActualizarListoParaServir')->add(\MWAceso::class . ':esBartender'); //* It Works
});

$app->get(
  '[/]', function (Request $request, Response $response) {
    $response->getBody()->write("Slim Framework 4 PHP Eduardo Sosa");
    return $response;
  }
);

$app->run();