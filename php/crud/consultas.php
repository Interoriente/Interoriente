<?php

if (isset($_POST['id']) || isset($_POST['carrito']) || isset($_POST['idUsuarioLogeado'])) {
  if ($_POST['id']) {
    $id = $_POST['id'];
    addCarrito($id);
  } else if (isset($_POST['carrito'])) {
    $carrito = $_POST['carrito'];
    $carrito = json_decode($carrito);
    almacenarCarrito($carrito);
  } else {
    $checkout = new Checkout();
    $checkout = $checkout->validarDireccion();
    echo $checkout;
  }
}

function getIdUsuario()
{
  session_start();
  $idUsuario = $_SESSION['documentoIdentidad'];
  if (isset($idUsuario)) {
    echo $idUsuario;
  } else {
    echo "No es posible obtener id porque la sesión no existe";
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
        as IMG ON PU.idPublicacion = IMG.publicacionImagen */ WHERE validacionPublicacion='1' order by rand()";

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
  $sql = "SELECT idPublicacion as 'id', 
          nombrePublicacion as 'titulo', 
          costoPublicacion as 'costo'
          FROM tblPublicacion 
          WHERE idPublicacion = $id";

  $consulta = $pdo->prepare($sql);
  $consulta->execute();
  $resultado = $consulta->fetchAll(\PDO::FETCH_ASSOC);
  /* Función para reducir el arreglo a una sola dimensión */
  function simplificarArreglo($array)
  {
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
function almacenarCarrito($carrito)
{
  session_start(); // Se debe usar antes de tratar de acceder a una variable de sessión
  $idUsuario = $_SESSION['documentoIdentidad'];

  if ($idUsuario) {
    require('../../dao/conexion.php');
    foreach ($carrito as $item) {
      $idPubli = $item->id;
      $cantidad = $item->cantidad;
      $sql = "INSERT INTO tblCarrito 
      (idPublicacionCarrito, docIdentidadCarrito, cantidadCarrito)
      VALUES(:idPubli, :idUser, :cantidad)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':idPubli', $idPubli);
      $stmt->bindValue(':idUser', $idUsuario);
      $stmt->bindValue(':cantidad', $cantidad);
      $stmt->execute();
    }
    echo 1;
  } else {
    echo 'La sesión no existe';
  }

}
/* Check-out */

class Checkout{

  public function getCheckoutInfo(){
    require('../../dao/conexion.php');
    $sql = "SELECT US.emailUsuario as 'email', CA.cantidadCarrito as 'cantidad',
    PU.nombrePublicacion as 'titulo', PU.costoPublicacion as 'costo'
    FROM tblUsuario as US INNER JOIN tblCarrito as CA ON CA.docIdentidadCarrito = US.documentoIdentidad
    INNER JOIN tblPublicacion as PU ON PU.idPublicacion = CA.idPublicacionCarrito";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $resultado;
  }
  
  public function validarDireccion(){
    session_start();
    $idUsuario = $_SESSION['documentoIdentidad'];
    if (isset($idUsuario)) {
      require('../../dao/conexion.php');
      $sql = "SELECT * FROM tblDirecciones
      WHERE docIdentidadDireccion = $idUsuario";
   /*    $sql = "SELECT idDireccion FROM tbldirecciones
      WHERE docIdentidadDireccion = $idUsuario"; */
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll();
      return $resultado;
    } else {
      return "La sesión no existe";
    }
  }

}
