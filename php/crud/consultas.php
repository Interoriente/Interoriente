<?php    
  
  function getPublicaciones(){
      /* Llamado a la base de datos*/
      require ('../../dao/conexion.php'); 
        /* Consulta */

        $sql = "SELECT * 
        FROM tblPublicacion /* as PU
        INNER JOIN tblImagenes 
        as IMG ON PU.idPublicacion = IMG.publicacionImagen */";

        /* Envío de la consulta a través del objeto PDO */
        $consulta = $pdo->prepare($sql);   /* PDO statement-> Ejecutarlo */
        /* Ejecución de la consulta */
        $consulta->execute();
        /* Obteniendo resultado de tipo objeto (Arreglo) */
        $resultado = $consulta->fetchAll();
        /* Devolviendo resultado */
        return $resultado;
       
    }

