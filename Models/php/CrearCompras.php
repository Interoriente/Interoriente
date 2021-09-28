<?php
getRandomFecha();
function setFactura()
{
    require 'conexion.php';
    $fecha = getRandomFecha();
    $user = getUsuario();
    $id =  $user["id"];
    $email = $user["email"];
    $direcciones = [
        'Carrera 23 No. 44 AC 21',
        'Calle 23 No. 23 21',
        'Carrera 34 No. 35 26',
        'Calle 22 No. 56 AD 23',
        'Avenida 23 456 AC 23'
    ];
    $dir = rand(0, 4);
    $sql = "INSERT INTO tblFactura 
    VALUES(null, :id, :fecha, :direccion, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":fecha", $fecha);
    $stmt->bindValue(":direccion", $direcciones[$dir]);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    $idFactura = $pdo->lastInsertId();
    setFacturaPublicacion($idFactura);
}

function setFacturaPublicacion($idFac)
{
    require 'conexion.php';
    $publicacion = getPublicacion();
    $id = $publicacion["id"];
    $cantidad = rand(1, 30);
    $sql = "INSERT INTO tblFacturaPublicacion
    VALUES($idFac, $id, $cantidad)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

function getPublicacion()
{
    require 'conexion.php';
    $sql = "SELECT idPublicacion AS id
    FROM tblPublicacion ORDER BY RAND() LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUsuario()
{
    require 'conexion.php';
    $sql = "SELECT documentoIdentidad AS id, emailUsuario AS email
    FROM tblUsuario ORDER BY RAND() LIMIT 1
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getRandomFecha()
{
    require 'conexion.php';
    $mesActual = date("m");
    $diaActual = date("d");
    $ano = strval(rand(2020, 2021));
    $mes = strval(rand(01, $mesActual));
    if ($mes == $mesActual) {
        $dia = strval(rand(01, $diaActual));
    } else {
        if ($mes == '02') {
            $dia = strval(rand(01, 28));
        } else {
            $dia = strval(rand(01, 30));
        }
    }
    $randFecha = null;
    $randFecha .= $ano . '-';
    if ($dia < 10 ||  $mes < 10) {
        if ($mes < 10  && $dia < 10) {
            $randFecha .= "0" . $mes . '-';
            $randFecha .= "0" . $dia;
        } else {
            if ($mes < 10) {
                $randFecha .= "0" . $mes . '-';
                $randFecha .= $dia;
            } else {
                $randFecha .= $mes . '-';

                $randFecha .= "0" . $dia;
            }
        }
    } else {
        $randFecha .= $mes . '-';
        $randFecha .= $dia;
    }
    return $randFecha;
}
