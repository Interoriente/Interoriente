<?php
/* Pasos:
    1. Obtener id de las ciudades
    2. Obtener id de un usuario
    3. Insertar registro con una PK aleatoria teniendo en cuenta el id de la ciudad y el del usuario
*/
setDireccion();
function setDireccion(){
    require 'conexion.php';
    $docId = getUsuario();
    $tituloDirecciones = [
        "Casa", 
        "Oficina", 
        "Apartamento",
        "Hotel"];
    $direcciones = [
        'Carrera 23 No. 44 AC 21',
        'Calle 23 No. 23 21',
        'Carrera 34 No. 35 26',
        'Calle 22 No. 56 AD 23',
        'Avenida 23 456 AC 23'
    ];
    $nombreDir = $tituloDirecciones[rand(0,1)]; 
    $ciudadDir = getCiudad();
    $direccion = $direcciones[rand(0, 4)];
    $sql = "INSERT INTO tblDirecciones
    VALUES (null, :docId, :nombreDir, :direccion, :ciudadDir)";
    $stmt = $pdo->prepare($sql);
    //Nota: Recordar usar bindValue para evitar errores en la consulta
    $stmt->bindValue(":docId", $docId);
    $stmt->bindValue(":nombreDir", $nombreDir);
    $stmt->bindValue(":direccion", $direccion);
    $stmt->bindValue(":ciudadDir", $ciudadDir);
    $stmt->execute();
    $sqlUsuario = "UPDATE tblUsuario 
    SET estadoDir = 1 
    WHERE documentoIdentidad = :docId"; 
    $stmtUsuario = $pdo->prepare($sqlUsuario);
    $stmtUsuario->bindValue(":docId", $docId);
    $stmtUsuario->execute();
}

function getUsuario(){
    require 'conexion.php';
    $sql = "SELECT documentoIdentidad AS docId 
    FROM tblUsuario 
    WHERE estadoDir = 0
    ORDER BY RAND() 
    LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetch();
    return $resultado[0];
}

function getCiudad(){
    require 'conexion.php';
    $sql = "SELECT idCiudad AS id FROM tblCiudad 
    ORDER BY RAND() LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetch();
    return $resultado[0];
}