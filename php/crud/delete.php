<?php
  //Llamada a la conexion
  include_once '../../dao/conexion.php';
  $id =$_GET['id']; //Revisar después

  //sentencia sql para eliminar
  $sql_eliminar = "DELETE FROM tblusuarios WHERE idusuario = ?";
  $consulta_eliminar = $pdo ->prepare($sql_eliminar);
  $consulta_eliminar->execute(array($id));
  //redireccionar
  header('location:index.php');