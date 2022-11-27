<?php
use Illuminate\Support\Facades\Log;

require_once './models/Usuario.php';
require_once './models/login.php';

class LoginController extends Usuario
{


    public function verificarUsuario($request, $response, $args)
    {
        $params = $request->getParsedBody();
        $nombre_usuario = trim($params['nombre_usuario']);
        $pass = ($params['clave']);

        $user = Usuario::obtenerUsuario($nombre_usuario);

        $payload = json_encode(array('status' => 'Usuario invalido'));
        if (!is_null($user)) {
            if (password_verify($pass, $user->clave)) {
                $userData = array(
                    'nombre' => $user->nombre,
                    'tipo' => $user->tipo,
                    'id' => $user->id
                );

                $payload = json_encode(
                    array(
                        'Token' => AutentificadorJWT::CrearToken($userData),
                        'response' => 'Usuario valido',
                        'tipo' => $user->tipo
                    )
                );
                $idLoginInserted = Usuario::insertLogin($user);

                if ($idLoginInserted > 0) {
                    echo "Login inserted successfully";
                }
            }
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function generarCsv($request, $response, $args)
    {
        $logins = Login::obtenerTodos();
        if (Login::EscribirCsv($logins)) {
            $payload = json_encode($logins);
        } else {
            $payload = json_encode(array("Error" => "fallo en la generacion del archivo csv"));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function ActualizarLoginsUsandoCsv($request, $response, $args)
    {

        if (Login::LeerCsv()) {
            $logins = Login::obtenerTodos();
            $payload = json_encode($logins);
        } else {
            $payload = json_encode(array("Error" => "fallo en la generacion del archivo csv"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function TraerTodos($request, $response, $args)
    {
        $logins = Login::obtenerTodos();
        $payload = json_encode($logins);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $id = $args['id'];
        $id_usuario = $parametros['id_usuario'];
        $nombre_usuario = $parametros['nombre_usuario'];
        $fecha_login = $parametros['fecha_login'];
        // Creamos el Mesa
        $log = new Login();
        $log->id = $id;
        $log->id_usuario = $id_usuario;
        $log->nombre_usuario = $nombre_usuario;
        $log->fecha_login = $fecha_login;
    
    
        Login::modificarLogin($log);
        $payload = json_encode(array("mensaje" => "Log modificado con exito"));
    
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    
  public function BorrarUno($request, $response, $args)
  {
    $id = $args['id'];
    Login::borrarLogin($id);

    $payload = json_encode(array("mensaje" => "Log borrado con exito"));
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

}
?>