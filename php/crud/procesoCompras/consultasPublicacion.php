<?php
/* Llamado a la bd */
require_once "../../../dao/conexion.php";

/* Espacio para las demás consultas */

//Eliminar Elemento 
$id = $_POST['eliminar'] ?? null; //Si el id existe, úselo. Sino (??) asígnele null;

if (!$id) {
    header("Location:../../../principal/publicacion/index.php");
    exit;
}else{
    $stmt = $pdo->prepare('DELETE FROM tblCarrito WHERE idPublicacion = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    header("Location:../../../principal/publicacion/index.php");
}
