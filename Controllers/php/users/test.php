<?php

var_dump(verificarCarrito(123456789));

function verificarCarrito($docId){
    require '../../../Models/dao/conexion.php';
    $sql = "CALL sp_verificarCarrito(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $docId);
    $stmt->execute();
    return $stmt->fetch();
  }