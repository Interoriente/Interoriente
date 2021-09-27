<?php
$resultado = consulta();
$img = [];
foreach ($resultado as $publi) {
 array_push($img, $publi["urlImagen"]);
}
print_r($img);
/* print_r($resultado);
 */
function consulta(){
    require('../../../Models/dao/conexion.php');
    $sql = "SELECT IMG.urlImagen,PU.idPublicacion,PU.nombrePublicacion,PU.descripcionPublicacion,
    PU.costoPublicacion,PU.stockPublicacion,PU.validacionPublicacion
    FROM tblPublicacion as PU
    INNER JOIN tblImagenes as IMG 
    ON PU.idPublicacion = IMG.publicacionImagen
    WHERE validacionPublicacion='1'
/*     GROUP BY PU.idPublicacion */
    ORDER BY rand()
    LIMIT 5";
    
    $consulta = $pdo->prepare($sql);   /* PDO statement-> Ejecutarlo */
      /* Ejecución de la consulta */
      $consulta->execute();
      /* Obteniendo resultado de tipo objeto (Arreglo) */
      return $consulta->fetchAll(PDO::FETCH_NAMED);
} 