<?php
$documento = $_SESSION["documentoIdentidad"];
$sesionRol = $_SESSION['roles'];
include_once '../../../dao/conexion.php';
$sqlValidacion = "SELECT *
FROM tblUsuario AS US
INNER JOIN tblUsuarioRol AS UR 
ON UR.docIdentidadUsuarioRol = US.documentoIdentidad
WHERE US.documentoIdentidad = :id AND US.estadoUsuario = 1";
$stmt = $pdo->prepare($sqlValidacion);
$stmt->bindParam(':id', $documento);
$stmt->execute();
$contadorValidacion = $stmt->rowCount();
if ($contadorValidacion) {
    $objetoRol = $stmt->fetch(PDO::FETCH_OBJ);
}