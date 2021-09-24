<?php

/* Plan:

Inserción datos en tblFactura y tblFacPu

*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* print_r(setFactura()); */
/* echo setFactura(); */
/* print_r(setFacturaPublicacion()); */
echo setFactura();

function setFactura(){
    require 'conexion.php';
    $fecha = getRandomFecha();
    $user = getUsuario();
    $id =  $user["id"];
    $email = $user["email"];
    $direccion = 'Carrera 23 No. 44 AC 21';
    $sql = "INSERT INTO tblFactura 
    VALUES(null, :id, :fecha, :direccion, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":fecha", $fecha);
    $stmt->bindValue(":direccion", $direccion);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    $idFactura = $pdo->lastInsertId();
    setFacturaPublicacion($idFactura);
}

function setFacturaPublicacion($idFac){
    require 'conexion.php';
    $publicacion = getPublicacion();
    $id = $publicacion["id"];    
    $cantidad = rand(1, 30);
    $sql = "INSERT INTO tblFacturaPublicacion
    VALUES($idFac, $id, $cantidad)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

function getPublicacion(){
    require 'conexion.php';
    $sql = "SELECT idPublicacion AS id
    FROM tblPublicacion ORDER BY RAND() LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUsuario(){
    require 'conexion.php';
    $sql = "SELECT documentoIdentidad AS id, emailUsuario AS email
    FROM tblUsuario ORDER BY RAND() LIMIT 1
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getRandomFecha(){
    $ano = strval(rand(2015, 2021));
    $mes = strval(rand(01, 12));
    $dia = strval(rand(01, 28));
    $randFecha = null;
    $randFecha .= $ano . '-' ;
    if ($dia < 10 ||  $mes < 10) {
        if ($mes < 10  && $dia < 10) {
            $randFecha .= "0" . $mes . '-';
            $randFecha .= "0" . $dia;
        } else {
            if ($mes < 10) {
                $randFecha .= "0" . $mes . '-';  
                $randFecha .= $dia;
            }else{
             $randFecha .= $mes . '-';

                $randFecha .= "0" . $dia;
            }
        }
    }else{
        $randFecha .= $mes . '-';
        $randFecha .= $dia;
    }
    return $randFecha;
}