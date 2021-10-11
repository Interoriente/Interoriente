<?php

if (
  isset($_POST['id']) ||
  isset($_POST['carrito']) ||
  isset($_POST['idUsuarioLogeado']) ||
  isset($_POST['ciudades']) ||
  isset($_POST['checkout'])
) {

  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    addCarrito($id);
  } else if (isset($_POST['carrito'])) {
    $carrito = $_POST['carrito'];
    $carrito = json_decode($carrito);
    almacenarCarrito($carrito);
  } else if (isset($_POST['idUsuarioLogeado'])) {
    $checkout = new Checkout();
    $valDirecciones = $checkout->validarDireccion();
    echo $valDirecciones;
  } else if (isset($_POST['ciudades'])) {
    $checkout = new Checkout();
    $ciudades = $checkout->getCiudades();
    echo $ciudades;
  } else {
    $userData = $_POST['checkout'];
    $direccion = $userData[0];
    $email = $userData[1];
    $checkout = new Checkout();
    $respuesta = $checkout->finalizarCompra($direccion, $email);
    echo $respuesta;
  }
}
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
/* Función para obtener el id un usuario que tenga la sesión iniciada */
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

/* Funcion para llamar publicaciones en el index */
function getPublicaciones()
{
  try {

    /* Llamado a la base de datos*/
    require('../../Models/dao/conexion.php');
    /* Consulta */

    $sql = "CALL sp_getPublicaciones()";

    /* Envío de la consulta a través del objeto PDO */
    $consulta = $pdo->prepare($sql);   /* PDO statement-> Ejecutarlo */
    /* Ejecución de la consulta */
    $consulta->execute();
    /* Obteniendo resultado de tipo objeto (Arreglo) */
    $resultado = $consulta->fetchAll();
    /* Devolviendo resultado */
    return $resultado;
  } catch (\Throwable $th) {
    /*echo "<script>alert('Ocurrió un error!');</script>";*/
  }
}

/* Función para agregar publicaciones al carrito */
function addCarrito($id)
{
  try {

    require '../../../Models/dao/conexion.php';
    /* 
      -Título
      -imagen
      -precio
      */
    $sql = "CALL sp_addCarrito(:id)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindValue(":id", $id);
    $consulta->execute();
    $resultado = $consulta->fetchAll(\PDO::FETCH_ASSOC);

    $resultado = simplificarArreglo($resultado);
    /* Resultado a devolver */
    echo json_encode($resultado);
  } catch (\Throwable $th) {
    /*echo "<script>alert('Ocurrió un error!');</script>";*/
  }
}

/* función para guardar información del carrito en tblCarrito */
function almacenarCarrito($carrito)
{
  try {
    session_start(); // Se debe usar antes de tratar de acceder a una variable de sessión
    $idUsuario = $_SESSION['documentoIdentidad'];

    if ($idUsuario) {
      require('../../../Models/dao/conexion.php');
      foreach ($carrito as $item) {
        $idPubli = $item->id;
        $cantidad = $item->cantidad;
        $sql = "CALL sp_almacenarCarrito";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idPubli', $idPubli);
        $stmt->bindValue(':idUser', $idUsuario);
        $stmt->bindValue(':cantidad', $cantidad);
        $stmt->execute();
      }
      echo 1;
    } else {
      echo "<script>alert('No existe la sesión!');</script>";
    }
  } catch (\Throwable $th) {
    /*echo "<script>alert('Ocurrió un error!');</script>";*/
  }
}

/* Clase Check-out con funciones implicadas */

class Checkout
{
  public function getCheckoutInfo()
  {
    try {
      require '../../Models/dao/conexion.php';
      session_start();
      $idUsuario = $_SESSION['documentoIdentidad'];
      $sql = "CALL sp_getCheckoutInfo()";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":id", $idUsuario);
      $stmt->execute();
      $resultado = $stmt->fetchAll();
      return $resultado;
    } catch (\Throwable $th) {
      /*echo "<script>alert('Ocurrió un error!');</script>";*/
    }
  }

  public function validarDireccion()
  {
    try {
      session_start();
      $idUsuario = $_SESSION['documentoIdentidad'];
      if (isset($idUsuario)) {
        /* TODO: TENER EN CUENTA AQUELLOS CASOS EN LOS QUE LA VARIABLE NO ESTÉ ASIGNADA*/
        require('../../../Models/dao/conexion.php');
        $sql = "SELECT DI.idDireccion as 'id', DI.nombreDireccion as 'nombreDireccion', 
      DI.descripcionDireccion as 'direccion', US.emailUsuario as 'correo'
      FROM tblDirecciones as DI INNER JOIN tblUsuario as US 
      ON US.documentoIdentidad = DI.docIdentidadDireccion
      WHERE DI.docIdentidadDireccion =$idUsuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC); /* FETCH_ASSOC permite devolver solo un tipo de arreglo, en este caso, asociativo */
        $resultado = json_encode($resultado);
        return $resultado;
      } else {
        $arr = array();
        return $arr;
      }
    } catch (\Throwable $th) {
      /*echo "<script>alert('Ocurrió un error!');</script>";*/
    }
  }

  public function getCiudades()
  {
    try {
      require '../../../Models/dao/conexion.php';
      $sql = "CALL sp_getCiudades()";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $resultado = json_encode($resultado);
      return $resultado;
    } catch (\Throwable $th) {
      /*echo "<script>alert('Ocurrió un error!');</script>";*/
    }
  }
  public function finalizarCompra($direccion, $email)
  {
    try {
      require('../../../Models/dao/conexion.php');
      session_start();
      $idUsuario = $_SESSION['documentoIdentidad'];
      /* Almacenar información de la compra */
      $sqlFa = "sp_insertarFactura(:idUser,:direccion,:email)";
      $stmt = $pdo->prepare($sqlFa);
      $stmt->bindValue(':idUser', $idUsuario);
      $stmt->bindValue(':direccion', $direccion);
      $stmt->bindValue(':email', $email);
      $stmt->execute();
      $idFactura = $pdo->lastInsertId(); //Regresar el id del último registro insertado
      /* Almacenar información en tabla intermedia tblfacturapublicacion */
      $sqlCa = "CALL sp_mostrarIdCarrito(:id)";
      $stmtCa = $pdo->prepare($sqlCa);
      $stmtCa->bindValue(":id", $idUsuario);
      $stmtCa->execute();
      $respuesta = $stmtCa->fetchAll(PDO::FETCH_ASSOC);
      foreach ($respuesta as $fila) {
        $idPubli = $fila['idPu'];
        $cantidad = $fila['cantidad'];
        $sqlFacPu = "CALL sp_insertarFacturaPublicacion (:idFact, :idPubli, :cantidad)";
        $stmtFacPu = $pdo->prepare($sqlFacPu);
        $stmtFacPu->bindValue(':idFact', $idFactura);
        $stmtFacPu->bindValue(':idPubli', $idPubli);
        $stmtFacPu->bindValue(':cantidad', $cantidad);
        $stmtFacPu->execute();
        //Restar stock a la publicación
        $sqlStock = "CALL sp_actualizarExistencia(:id,:cantidad";
        $stmtStock = $pdo->prepare($sqlStock);
        $stmtStock->execute();

        /* Eliminar información de la tabla carrito */
        $sqlDeleteCart = "CALL sp_borrarCarrito(:id,:documento)";
        $stmtDeleteCart = $pdo->prepare($sqlDeleteCart);
        $stmtDeleteCart->bindValue(":id",$idPubli);
        $stmtDeleteCart->bindValue(":documento",$idUsuario);
        $stmtDeleteCart->execute();
      }
      return "Proceso de Compras Finalizado!!";
    } catch (\Throwable $th) {
      /*echo "<script>alert('Ocurrió un error!');</script>";*/
    }
  }
}
class Compra
{
  public int $id;

  public function __construct($id)
  {
    $this->id = $id;
  }
  public function FacturasCreadas($id)
  {
    try {
      require('../../../Models/dao/conexion.php');
      $sql = "CALL sp_facturasCreadas(:id)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":id", $id);
      $stmt->execute();
      return $stmt->fetchAll();
    } catch (\Throwable $th) {
      /*echo "<script>alert('Ocurrió un error!');</script>";*/
    }
  }
}
class Factura
{
  public int $id;
  public int $numero;

  public function __construct($id, $numero)
  {
    $this->id = $id;
    $this->numero = $numero;
  }
  public function CuerpoFactura($id, $numero)
  {
    try {
      require('../../../Models/dao/conexion.php');
      $sqlMisCompras = "CALL sp_cuerpoFactura(:id,:numero)";
      $stmt = $pdo->prepare($sqlMisCompras);
      $stmt->bindValue(":id", $id);
      $stmt->bindValue(":numero", $numero);
      $stmt->execute();
      return $stmt->fetchAll();
    } catch (\Throwable $th) {
      /*echo "<script>alert('Ocurrió un error!');</script>";*/
    }
  }
  public function EncabezadoFactura($id, $numero)
  {
    try {
      require('../../../Models/dao/conexion.php');
      $sql   = "CALL sp_encabezadoFactura(:id,:numero)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":id", $id);
      $stmt->bindValue(":numero", $numero);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (\Throwable $th) {
      /*echo "<script>alert('Ocurrió un error!');</script>";*/
    }
  }
}
