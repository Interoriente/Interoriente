<?php
$host = "mysql:host=localhost;dbname=interori_prueba"; 
$usuario = "interori_interori";
$contrasena = "B4O#uJ]C#%,4";

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