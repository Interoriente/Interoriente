<?php

$carrito = getCarrito(123456789);
foreach ($carrito as $i) {
 echo $i["id"] . "<br>"; 
  # code...
}

function verificarCarrito($docId){
    require '../../../Models/dao/conexion.php';
    $sql = "CALL sp_verificarCarrito(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $docId);
    $stmt->execute();
    return $stmt->fetch();
  }

  function getCarrito($id){
    require('../../../Models/dao/conexion.php');
    $sql = "CALL sp_getCarrito(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }