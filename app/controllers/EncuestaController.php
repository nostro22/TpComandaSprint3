<?php
use function React\Promise\map;

require_once './models/Encuesta.php';
require_once './interfaces/IApiUsable.php';

class EncuestaController extends Encuesta implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $codigo_orden = $parametros['codigo_orden'];
    $codigo_mesa = $parametros['codigo_mesa'];
    $mesa_calificacion = $parametros['mesa_calificacion'];
    $restaurante_calificacion = $parametros['restaurante_calificacion'];
    $mozo_calificacion = $parametros['mozo_calificacion'];
    $cocina_calificacion = $parametros['cocina_calificacion'];
    $comentario = $parametros['comentario'];

    // Creamos el Encuesta
    $encuesta = new Encuesta();
    $encuesta->id_orden = $codigo_orden;
    $encuesta->id_mesa = $codigo_mesa;
    $encuesta->mesa_calificacion = $mesa_calificacion;
    $encuesta->restaurante_calificacion = $restaurante_calificacion;
    $encuesta->mozo_calificacion = $mozo_calificacion;
    $encuesta->cocinero_calificacion = $cocina_calificacion;
    $encuesta->comentario = $comentario;
    $encuesta->crearEncuesta();

    $payload = json_encode(array("mensaje" => "Encuesta creado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerUno($request, $response, $args)
  {
    // Buscamos Encuesta por id
    $encuesta = $args['id'];
    $Encuesta = Encuesta::obtenerEncuesta($encuesta);
    $payload = json_encode($Encuesta);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
  public function TraerMejoresComentarios($request, $response, $args)
  {
    $Encuesta = Encuesta::obtenerMejoresComentarios();
    $payload = json_encode($Encuesta);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
  public function TraerPeoresComentarios($request, $response, $args)
  {
    $Encuesta = Encuesta::obtenerPeoresComentarios();
    $payload = json_encode($Encuesta);

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    $lista = Encuesta::obtenerTodos();
    $filtro = "todos";
    Encuesta::imprimirEncuestas($lista);
    $payload = json_encode(array("listaEncuesta" => $lista));
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ModificarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $id = $args["id"];

    $codigo_orden = $parametros['codigo_orden'];
    $codigo_mesa = $parametros['codigo_mesa'];
    $mesa_calificacion = $parametros['mesa_calificacion'];
    $restaurante_calificacion = $parametros['restaurante_calificacion'];
    $mozo_calificacion = $parametros['mozo_calificacion'];
    $cocinero_calificacion = $parametros['cocinero_calificacion'];
    $comentario = $parametros['comentario'];

    // Creamos el Encuesta
    $encuesta = new Encuesta();
    $encuesta->id = $id;
    $encuesta->id_orden = $codigo_orden;
    $encuesta->id_mesa = $codigo_mesa;
    $encuesta->mesa_calificacion = $mesa_calificacion;
    $encuesta->restaurante_calificacion = $restaurante_calificacion;
    $encuesta->mozo_calificacion = $mozo_calificacion;
    $encuesta->cocinero_calificacion = $cocinero_calificacion;
    $encuesta->comentario = $comentario;
    Encuesta::modificarEncuesta($encuesta);
    $payload = json_encode(array("mensaje" => "Encuesta modificado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function BorrarUno($request, $response, $args)
  {
    $EncuestaId = $args['id'];
    Encuesta::borrarEncuesta($EncuestaId);

    $payload = json_encode(array("mensaje" => "Encuesta borrado con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

}