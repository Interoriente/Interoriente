<?php
$host = "mysql:host=localhost;dbname=interori_prueba";

try {
     //Conexion exitosa	
     $pdo = new PDO($host);
     $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Conexión exitosa";
} catch (PDOException $e) {      
     //Error Conexion
     print "Error!". $e->getMessage() ."br/>";
     die();
}
?>