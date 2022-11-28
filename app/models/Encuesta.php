<?php
//eduardo
class Encuesta
{
    public $id;
    public $id_orden;
    public $id_mesa;
    public $mesa_calificacion;
    public $restaurante_calificacion;
    public $mozo_calificacion;
    public $cocinero_calificacion;
    public $comentario;
 

    public function getPromedio()
    {
        return (($this->mesa_calificacion + $this->restaurante_calificacion + $this->mozo_calificacion + $this->cocinero_calificacion)/4); 
    }

    public function __construct(){
    }
    public function crearEncuesta()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO Encuestas 
        (id_orden, id_mesa, mesa_calificacion, restaurante_calificacion, 
        mozo_calificacion, cocinero_calificacion, comentario, promedio_calificacion)
        VALUES (:id_orden, :id_mesa, :mesa_calificacion, :restaurante_calificacion, 
        :mozo_calificacion, :cocinero_calificacion, :comentario, :promedio_calificacion)");
        $consulta->bindValue(':id_orden', $this->id_orden, PDO::PARAM_STR);
        $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_STR);
        $consulta->bindValue(':mesa_calificacion', $this->mesa_calificacion, PDO::PARAM_INT);
        $consulta->bindValue(':restaurante_calificacion', $this->restaurante_calificacion, PDO::PARAM_INT);
        $consulta->bindValue(':mozo_calificacion', $this->mozo_calificacion, PDO::PARAM_INT);
        $consulta->bindValue(':cocinero_calificacion', $this->cocinero_calificacion, PDO::PARAM_INT);
        $consulta->bindValue(':comentario', $this->comentario, PDO::PARAM_STR);
        $consulta->bindValue(':promedio_calificacion', $this->getPromedio(), PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM Encuestas");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Encuesta');
    }

    public static function obtenerEncuesta($id)
    {        
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM Encuestas WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        $Encuesta =$consulta->fetchObject('Encuesta');
        if(is_null($Encuesta)){
            throw new Exception("Encuesta no econtrado");
        }
        return $Encuesta;
    }

    public static function obtenerMejoresComentarios()
    {        
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT comentario FROM Encuestas WHERE promedio_calificacion > 8");
        $consulta->execute();
        $Encuesta =$consulta->fetchAll(PDO::FETCH_COLUMN, 0);
        if(is_null($Encuesta)){
            throw new Exception("Encuesta no econtrado");
        }
        return $Encuesta;
    }
    public static function obtenerPeoresComentarios()
    {        
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT comentario FROM Encuestas WHERE promedio_calificacion < 3");
        $consulta->execute();
        $Encuesta =$consulta->fetchAll(PDO::FETCH_COLUMN, 0);
        if(is_null($Encuesta)){
            throw new Exception("Encuesta no econtrado");
        }
        return $Encuesta;
    }

    public static function modificarEncuesta($Encuesta)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE Encuestas 
        SET 
        id_orden = :id_orden,
        id_mesa = :id_mesa ,
        mesa_calificacion = :mesa_calificacion ,
        restaurante_calificacion = :restaurante_calificacion ,
        cocinero_calificacion = :cocinero_calificacion,
        mozo_calificacion = :mozo_calificacion,
        comentario = :comentario,
        promedio_calificacion = :promedio_calificacion
        WHERE id = :id",);
         $consulta->bindValue(':id', $Encuesta->id, PDO::PARAM_INT);
         $consulta->bindValue(':id_orden', $Encuesta->id_orden, PDO::PARAM_STR);
         $consulta->bindValue(':id_mesa', $Encuesta->id_mesa, PDO::PARAM_STR);
         $consulta->bindValue(':mesa_calificacion', $Encuesta->mesa_calificacion, PDO::PARAM_INT);
         $consulta->bindValue(':restaurante_calificacion', $Encuesta->restaurante_calificacion, PDO::PARAM_INT);
         $consulta->bindValue(':mozo_calificacion', $Encuesta->mozo_calificacion, PDO::PARAM_INT);
         $consulta->bindValue(':cocinero_calificacion', $Encuesta->cocinero_calificacion, PDO::PARAM_INT);
         $consulta->bindValue(':comentario', $Encuesta->comentario, PDO::PARAM_STR);
         $consulta->bindValue(':promedio_calificacion', $Encuesta->getPromedio(), PDO::PARAM_STR);
         $consulta->execute();
    }

    public static function borrarEncuesta($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("DELETE FROM Encuestas WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

    public function imprimirEncuestas($lista){
        echo "<table border='2'>";
        echo '<caption> Datos</caption>';
        echo "<th>[ID]</th><th>[Codigo orden]</th><th>[codigo mesa]</th><th>[Mesa]</th><th>[Restaurante]</th><th>[Mozo]</th><th>[Cocina]</th><th>[Comentario]</th><th>[Promedio]</th>";
        foreach($lista as $entity){
            {
                echo "<tr align='center'>";
                echo "<td>[".$entity->id."]</td>";
                echo "<td>[".$entity->id_orden."]</td>";
                echo "<td>[".$entity->id_mesa."]</td>";
                echo "<td>[".$entity->mesa_calificacion."]</td>";
                echo "<td>[".$entity->restaurante_calificacion."]</td>";
                echo "<td>[".$entity->mozo_calificacion."]</td>";
                echo "<td>[".$entity->cocinero_calificacion."]</td>";
                echo "<td>[".$entity->comentario."]</td>";
                echo "<td>[".$entity->promedio_calificacion."]</td>";
                echo "</tr>";
            }
        }
            echo "</table>" ;
        }

}