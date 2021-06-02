<?php
$host = "mysql:host=localhost;dbname=interori_prueba";
$usuario = "interori";
$contrasena = ":$SpZ3xSeh!H";

try {
     //Conexion exitosa	
     $pdo = new PDO($host, $usuario, $contrasena);
     $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Conexión exitosa";
} catch (PDOException $e) {      
     //Error Conexion
     print "Error! ". $e->getMessage();
     die();
}
?>