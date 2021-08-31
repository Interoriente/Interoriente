<?php

class Usuario
{

    public int $docId;
    


    public function __construct(int $docId)
    {
        $this->id = $docId;
    }


    public function getUserData($docId)
    {
        if (isset($docId)) {
            $sesionRol = $_SESSION['roles'];
            require '../../../dao/conexion.php';
            $sqlValidacion = "SELECT *
            FROM tblUsuario AS US
            INNER JOIN tblUsuarioRol AS UR 
            ON UR.docIdentidadUsuarioRol = US.documentoIdentidad
            WHERE US.documentoIdentidad = :id AND US.estadoUsuario = '1'";
            $stmt = $pdo->prepare($sqlValidacion);
            $stmt->bindParam(':id', $docId);
            $stmt->execute();
            $contadorValidacion = $stmt->rowCount();
            if ($contadorValidacion) {
                
                return $objetoRol = $stmt->fetch(PDO::FETCH_OBJ);
            }
        } else {
            return false;
        }
    }
    public function getDirecciones($docId)
    {
    
        require '../../../dao/conexion.php';
         $sqlDireccion = "SELECT 
          DI.idDireccion, 
          DI.nombreDireccion,
          DI.descripcionDireccion,
          CI.nombreCiudad,
          CI.idCiudad 
          FROM tblDirecciones as DI
          INNER JOIN tblCiudad as CI ON DI.ciudadDireccion = CI.idCiudad
          WHERE docIdentidadDireccion = ?";
        //Prepara sentencia
        $consultarDireccion = $pdo->prepare($sqlDireccion);
        //Ejecutar consulta
        $consultarDireccion->execute(array($docId));
        return $consultarDireccion->fetchAll();
    }
    public function getCiudades(){
        require('../../../dao/conexion.php');
        $sql = "SELECT idCiudad,
        nombreCiudad 
        FROM tblCiudad ORDER BY nombreCiudad";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
