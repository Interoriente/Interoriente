<?php
$resultado = consulta();
print_r($resultado);
function consulta(){
    require('../../../Models/dao/conexion.php');
    $sql = "SELECT IMG.urlImagen,PU.idPublicacion,PU.nombrePublicacion,PU.descripcionPublicacion,
    PU.costoPublicacion,PU.stockPublicacion,PU.validacionPublicacion
    FROM tblPublicacion as PU
    INNER JOIN tblImagenes as IMG 
    ON PU.idPublicacion = IMG.publicacionImagen
    WHERE validacionPublicacion='1'
    GROUP BY PU.idPublicacion
    LIMIT 1
    /* ORDER BY rand() */";
    
    $consulta = $pdo->prepare($sql);   /* PDO statement-> Ejecutarlo */
      /* Ejecución de la consulta */
      $consulta->execute();
      /* Obteniendo resultado de tipo objeto (Arreglo) */
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
} 