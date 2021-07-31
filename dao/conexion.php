<?php
$nombrehost="localhost";
$nombreBD="interori_interoriente";
$host = "mysql:host=$nombrehost;dbname=$nombreBD";

/* $usuario = "root";
$contrasena = ""; */

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