<?php
if (isset($_POST['id']) or isset($_POST['carrito'])) {
  if ($_POST['id']) {
    $id = $_POST['id'];
    addCarrito($id);
  } else {
    $carrito = $_POST['carrito'];
    $carrito = json_decode($carrito, true);
    almacenarCarrito($carrito);
  }
}

function getPublicaciones()
{
  /* Llamado a la base de datos*/
  require('../../dao/conexion.php');
  /* Consulta */

  $sql = "SELECT * 
        FROM tblPublicacion /* as PU
        INNER JOIN tblImagenes 
        as IMG ON PU.idPublicacion = IMG.publicacionImagen */";

  /* Envío de la consulta a través del objeto PDO */
  $consulta = $pdo->prepare($sql);   /* PDO statement-> Ejecutarlo */
  /* Ejecución de la consulta */
  $consulta->execute();
  /* Obteniendo resultado de tipo objeto (Arreglo) */
  $resultado = $consulta->fetchAll();
  /* Devolviendo resultado */

  return $resultado; 
}

/* Función para agregar publicaciones al carrito */
function addCarrito($id)
{
  require('../../dao/conexion.php');

    /* 
    -Título
    -imagen
    -precio
    */
  $sql = "SELECT idPublicacion as 'Id', 
          nombrePublicacion as 'Título', 
          costoPublicacion as 'Costo'
          FROM tblPublicacion 
          WHERE idPublicacion = $id";

  $consulta = $pdo->prepare($sql);
  $consulta->execute();
  $resultado = $consulta->fetchAll(\PDO::FETCH_ASSOC);
  /* Función para reducir el arreglo a una sola dimensión */
  function simplificarArreglo($array){
    if (!is_array($array)) {
      return false;
    }
    $resultado = array();
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $resultado = array_merge($resultado, simplificarArreglo($value));
      } else {
        $resultado[$key] = $value;
      }
    }
    return $resultado;
  } 
  $resultado = simplificarArreglo($resultado);
  /* Resultado a devolver */
  echo json_encode($resultado);
}

/* función para guardar información del carrito en tblCarrito */
function almacenarCarrito($carrito){
  
  if (isset($_SESSION['documentoIdentidad'])) {
    require('../../dao/conexion.php');
    $idUsuario = $_SESSION['documentoIdentidad'];
    $sql = "INSERT INTO tblCarrito 
    VALUES(:idPubli, :idUsuario, :cantidad)";

    foreach ($carrito as $item) {
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':idPubli', $item->Id);
      $stmt->bindValue(':idUsuario', $idUsuario);
      $stmt->bindValue(':cantidad', $item->cantidad);
      $stmt->execute();
     
    }
    echo 'Almacenado!';
  } else {
    echo 'La sesión no existe';
  }
}
