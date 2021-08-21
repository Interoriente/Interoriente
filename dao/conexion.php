<?php
//Configurar zona horaria de Colombia
date_default_timezone_set('America/Bogota');

$nombrehost= "190.90.160.12"; //Dirección IP del host "Shared IP Address"
$nombreBD="interori_interoriente";
$host = "mysql:host=$nombrehost;dbname=$nombreBD";

$usuario = "interori_interori";
$contrasena = "B4O#ugJ]C#%,4";



try {
     //Conexion exitosa	
     $pdo = new PDO($host, $usuario, $contrasena);
     $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {      
     //Error Conexion
     print "Error! ". $e->getMessage();
     die();
}
?>