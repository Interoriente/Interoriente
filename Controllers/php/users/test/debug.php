<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

print_r(finalizarCompra("debug123", "debug@gmail.com"));
 
function finalizarCompra($direccion, $email)
  {
    try {
      require('../../../../Models/dao/conexion.php');
      session_start();
      $idUsuario = "123456789";
      /* Almacenar información de la compra */
      $sqlFa = "INSERT INTO `tblFactura`
        VALUES (null,:idUser,CURRENT_TIMESTAMP,:direccion,:email)";
      $stmt = $pdo->prepare($sqlFa);
      $stmt->bindValue(':idUser', $idUsuario);
      $stmt->bindValue(':direccion', $direccion);
      $stmt->bindValue(':email', $email);
      $stmt->execute();
      $idFactura = $pdo->lastInsertId(); //Regresar el id del último registro insertado
      /* Almacenar información en tabla intermedia tblfacturapublicacion */
      
      $sqlCa = "SELECT idPublicacionCarrito as 'idPu',
        cantidadCarrito as 'cantidad' 
        FROM tblCarrito
        WHERE docIdentidadCarrito = :idUsuario";
      $stmtCa = $pdo->prepare($sqlCa);
      $stmtCa->bindValue(':idUsuario', $idUsuario);
      $stmtCa->execute();
      $respuesta = $stmtCa->fetchAll(PDO::FETCH_ASSOC);
     
      foreach ($respuesta as $fila) {
        

        $idPubli = $fila['idPu'];
        $cantidad = $fila['cantidad'];
        $sqlFacPu = "INSERT INTO tblFacturaPublicacion
          VALUES (:idFact, :idPubli, :cantidad)";
        $stmtFacPu = $pdo->prepare($sqlFacPu);
        $stmtFacPu->bindValue(':idFact', $idFactura);
        $stmtFacPu->bindValue(':idPubli', $idPubli);
        $stmtFacPu->bindValue(':cantidad', $cantidad);
        $stmtFacPu->execute();
        
        //Restar stock a la publicación
      /*   $sqlStock = "UPDATE tblPublicacion
          SET stockPublicacion = (cantidadPublicacion-$cantidad)
          WHERE idPublicacion =?";
        $stmtStock = $pdo->prepare($sqlStock);
        $stmtStock->execute(array($idPubli)); */

        /* Eliminar información de la tabla carrito */
        $sqlDeleteCart = "DELETE FROM tblCarrito 
          WHERE idPublicacionCarrito = :idPubli 
          AND docIdentidadCarrito = :idUsuario";
        $stmtDeleteCart = $pdo->prepare($sqlDeleteCart);
        $stmtDeleteCart->bindValue(':idPubli', $idPubli);
        $stmtDeleteCart->bindValue(':idUsuario', $idUsuario);
        $stmtDeleteCart->execute();
        return 3;
        
    }
} catch (\Throwable $th) {
      //throw $th;
    }
  }
