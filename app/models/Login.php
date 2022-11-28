<?php
//eduardo
class Login
{
    public $id;
    public $id_usuario;
    public $nombre_usuario;
    public $fecha_login;
 

    public function __construct(){
    }
    public function crearLogin()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO 
        Logins (id_usuario, nombre_usuario, fecha_login)");
        $consulta->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_STR);
        $consulta->bindValue(':nombre_usuario', $this->nombre_usuario, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_login', $this->fecha_login, PDO::PARAM_INT);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function crearLoginLocal($id_usuario,$nombre_usuario,$fecha_login)
    {
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("INSERT INTO logins (id_usuario, nombre_usuario, fecha_login) 
        VALUES (:id_usuario, :nombre_usuario, :fecha_login)");
        $query->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $query->bindValue(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
        $query->bindValue(':fecha_login', $fecha_login, PDO::PARAM_STR);
        $query->execute();

        return $objDataAccess->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM Logins");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Login');
    }

    public static function obtenerLogin($id)
    {        
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM Logins WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        $Login =$consulta->fetchObject('Login');
        if(is_null($Login)){
            throw new Exception("Login no econtrado");
        }
        return $Login;
    }



    public static function modificarLogin($Login)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE Logins 
        SET 
        id_usuario = :id_usuario,
        nombre_usuario = :nombre_usuario ,
        fecha_login = :fecha_login
        WHERE id = :id",);
        $consulta->bindValue(':id', $Login->id, PDO::PARAM_INT);
        $consulta->bindValue(':id_usuario', $Login->id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(':nombre_usuario', $Login->nombre_usuario, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_login', $Login->fecha_login, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function borrarLogin($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("DELETE FROM Logins WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

    public function imprimirLogins($lista,$promedio_calificacion){
        echo "<table border='2'>";
        echo '<caption> Datos</caption>';
        echo "<th>[ID]</th><th>[id usuario]</th><th>[Nombre Usuario]</th><th>[Fecha]</th>";
        foreach($lista as $entity){
            {
                echo "<tr align='center'>";
                echo "<td>[".$entity->id."]</td>";
                echo "<td>[".$entity->id_usuario."]</td>";
                echo "<td>[".$entity->nombre_usuario."]</td>";
                echo "<td>[".$entity->fecha_login."]</td>";
                echo "</tr>";
            }
        }
            echo "</table>" ;
    }

    
    public static function LeerCsv(){
        $file = fopen($_FILES['logins']['tmp_name'], "r");
        $retorno = false;
        try {
            if (!is_null($file) && self::borraTodosLosLogins() > 0){
                echo "<h2>Borrado los registros anteriores insertando respaldo</h2>";
            }
            while (!feof($file)) {
                $line = fgets($file);
                if (!empty($line)) {
                    $line = str_replace(PHP_EOL, "", $line);
                    $loginsArray = explode(",", $line);
                    Login::crearLoginLocal($loginsArray[0], $loginsArray[1], $loginsArray[2]);
                }
            }
        } catch (\Throwable $th) {
            echo "Error lectura de archivo";
        }finally{
            $retorno = true;
            fclose($file);
            return $retorno;
        }
    }

    public static function EscribirCsv($entitiesList, $filename = './Registros/logins.csv')
    {
        $success = false;
        $directory = dirname($filename, 1);
        
        try {
            if(!file_exists($directory)){
                mkdir($directory, 0777, true);
            }
            $file = fopen($filename, "w");
            if ($file) {
                foreach ($entitiesList as $entity) {
                    $line = $entity->id_usuario . "," . $entity->nombre_usuario . "," . $entity->fecha_login . PHP_EOL;
                    fwrite($file, $line);
                    $success = true;
                }
            }
        } catch (\Throwable $th) {
            echo "Error guardando archivo<br>";
        }finally{
            fclose($file);
        }
        return $success;
    }
 
    public static function borraTodosLosLogins(){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("DELETE FROM `logins` WHERE 1=1;");
        $query->execute();

        return $query->rowCount() > 0;
    }
}