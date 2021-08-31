<?php
class Publicaciones{

    public int $docId;

    public function __construct($docId)
    {
        $this->id = $docId;
        
    }

    public function ContarPublicaciones($docId){
        require '../../../dao/conexion.php';
        $sqlSesionPubli = "SELECT * 
        FROM tblPublicacion 
        WHERE docIdentidadPublicacion = ?";
        $consultaSesionPubli = $pdo->prepare($sqlSesionPubli);
        $consultaSesionPubli->execute(array($docId));
        return $resultadoSesionPubli = $consultaSesionPubli->rowCount();
    }

}