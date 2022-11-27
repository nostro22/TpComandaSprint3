<?php
use function React\Promise\map;

require_once './models/Mesa.php';
require_once './interfaces/IApiUsable.php';

class MesaController extends Mesa implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $id_personal = $parametros['id_personal'];
    $estado = $parametros['estado'];

    // Creamos el Mesa
    $usr = new Mesa();
    $usr->id_personal = $id_personal;
    $usr->estado = $estado;
    $usr->crearMesa();

    $payload = json_encode(array("mensaje" => "Mesa creada con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerUno($request, $response, $args)
  {
    // Buscamos Mesa por estado
    $id = array_slice($args['codigo_mesa'], 2);
    $Mesa = Mesa::obtenerMesa($id);
    $payload = json_encode($Mesa);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $lista = Mesa::obtenerTodos();
    $filtro = "todos";
    if (isset($args['id_personal'])) {
      $filtro = $args['id_personal'];
    }
    $new_array = array_filter($lista, function ($obj) use ($filtro) {
      if (isset($obj)) {
        foreach ($obj as $Mesa) {
          if ($filtro != "todos") {
            if ($obj->estado != $filtro)
              return false;
          }
        }
      }
      return true;
    });
    Mesa::imprimirMesas($lista, $filtro);
    $payload = json_encode(array("listaMesa" => $new_array));
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ModificarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $id = $args['id'];
    $codigo_mesa = $parametros['codigo_mesa'];
    $id_personal = $parametros['id_personal'];
    $estado = $parametros['estado'];
    // Creamos el Mesa
    $usr = new Mesa();
    $usr->id = $id;
    $usr->prefix = $codigo_mesa;
    $usr->id_personal = $id_personal;
    $usr->estado = $estado;


    Mesa::modificarMesa($usr);
    $payload = json_encode(array("mensaje" => "Mesa modificado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function BorrarUno($request, $response, $args)
  {
    $MesaId = $args['id'];
    Mesa::borrarMesa($MesaId);

    $payload = json_encode(array("mensaje" => "Mesa borrado con exito"));
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public static function GetDatosDelToken($request)
  {
    $header = $request->getHeader('Authorization');
    $token = trim(str_replace("Bearer", "", $header[0]));
    $user = AutentificadorJWT::ObtenerData($token);

    return $user;
  }

  public function TraerMesaMasUsada($request, $response, $args)
  {    
    $mesaMasUsada = Mesa::obtenerMesaMasUsada();
     
    $payload = json_encode($mesaMasUsada);
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  //Compara el id del mozo asociado a la mesa coincida con el proporcionado por el token 
  //Actualiza todas la mesas que esten lista para cobrar
  public function CobrarMesa($request, $response, $args)
  {

    $header = $request->getHeader('Authorization');
    $token = trim(str_replace("Bearer", "", $header[0]));
    $mozo = AutentificadorJWT::ObtenerData($token);
    $listaMesa = self::obtenerTodos();
    $listaPedidos = Orden::obtenerTodos();
    $listaMesasCobradas = [];
    foreach ($listaMesa as $mesa) {
      if ($mesa->id_personal == $mozo->id && $mesa->estado == "con cliente comiendo") {
        foreach ($listaPedidos as $pedido) {
          $codigo = $mesa->prefix . sprintf("%03d", $mesa->id);
          if ($codigo == $pedido->id_mesa && $pedido->estado == "servido") {
            $mesa->estado = "con cliente pagando";
            Mesa::modificarMesa($mesa);
            array_push($listaMesasCobradas,$mesa);
            break;
          }
        }
      }
    }
    $response->getBody()->write(json_encode($listaMesasCobradas));
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
  public function CerrarMesasCobradas($request, $response, $args)
  {

    $listaMesa = self::obtenerTodos();
    $listaMesasCerradas = [];
    foreach ($listaMesa as $mesa) {
      if ($mesa->estado == "con cliente pagando") {
            $mesa->estado = "cerrada";
            Mesa::modificarMesa($mesa);
            array_push($listaMesasCerradas,$mesa);
        }
      }
    $response->getBody()->write(json_encode($listaMesasCerradas));
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}