<?php
/* Capturando solicitud */
if (
  isset($_POST['id']) ||
  isset($_POST['carrito']) ||
  isset($_POST['idUsuarioLogeado']) ||
  isset($_POST['ciudades']) ||
  isset($_POST['checkout']) ||
  isset($_GET['tblCarrito']) ||
  isset($_POST['finalizar-compra']) ||
  isset($_POST['comprar'])
) {
  /* Verificando de dónde proviene y llamando respectiva función */
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    addCarrito($id);
  } else if (isset($_POST['carrito'])) {
    $carrito = $_POST['carrito'];
    $carrito = json_decode($carrito);
    echo almacenarCarrito($carrito);
  } else if (isset($_POST['idUsuarioLogeado'])) {
    $checkout = new Checkout();
    $valDirecciones = $checkout->validarDireccion();
    echo $valDirecciones;
  } else if (isset($_POST['ciudades'])) {
    $checkout = new Checkout();
    $ciudades = $checkout->getCiudades();
    echo $ciudades;
  } else if (isset($_GET['tblCarrito'])) {
    session_start();
    echo verificarCarrito($_SESSION['documentoIdentidad']);
  } else if (isset($_POST['finalizar-compra'])) {
    $direccion = "calle 34";
    $email = "rubenduque21";
    $compra = new Checkout();
    echo "<script>'Llegué hasta aquí'</script>;";
    $respuesta = $compra->finalizarCompra($direccion, $email);
  } else if (isset($_POST['comprar'])) {
    $comprar = $_POST['comprar'];
    echo almacenarCarritoCompra($comprar);
  } else {
    /* $userData = $_POST['checkout'];
    $direccion = $userData[0];
    $email = $userData[1];
    $checkout = new Checkout();
    $respuesta = $checkout->finalizarCompra($direccion, $email);
    echo json_encode($respuesta); */
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
/* Funcion para verificar si el usuario tiene publicaciones en la tabla carrito */

function verificarCarrito($docId)
{
  require '../../../Models/dao/conexion.php';
  $sql = "CALL sp_verificarCarrito(:id)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":id", $docId);
  $stmt->execute();
  return $stmt->fetchColumn();
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
}

/* Función para agregar publicaciones al carrito */
function addCarrito($id)
{

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
}

/* función para guardar información del carrito en tblCarrito */
function almacenarCarrito($carrito)
{

  /* $carrito = $carrito; */
  session_start(); // Se debe usar antes de tratar de acceder a una variable de sessión
  $idUsuario = $_SESSION['documentoIdentidad'];
  if (!isset($idUsuario)) {
    return 0;
  }
  $idsRepetidos = [];
  $cantidadesRepetidos = [];
  $contador = 0;
  if ($idUsuario) {
    require('../../../Models/dao/conexion.php');
    //Verificar si existen entradas duplicadas
    $carritoUsuario = getCarrito($idUsuario);
    $tamano = sizeof($carrito);
    foreach ($carritoUsuario as $idCarrito) {
      for ($i = 0; $i < $tamano; $i++) {
        if ($idCarrito["id"] == $carrito[$i]->id) {
          $idsRepetidos[$i] = $carrito[$i]->id;
          $cantidadesRepetidos[$i] = $idCarrito["cantidad"];
        }
      }
    }
    foreach ($carrito as $item) {
      if ($item->id == $idsRepetidos[$contador]) {
        $idPubli = $item->id;
        $cantidad = $item->cantidad + $cantidadesRepetidos[$contador];
        $sql = "CALL sp_actualizarCarrito(:cantidad, :idPubli,:idUser)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':cantidad', $cantidad);
        $stmt->bindValue(':idPubli', $idPubli);
        $stmt->bindValue(':idUser', $idUsuario);
        $stmt->execute();
        $contador++;
      } else {
        $idPubli = $item->id;
        $cantidad = $item->cantidad;
        $sql = "CALL sp_almacenarCarrito(:idPubli,:idUser,:cantidad)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idPubli', $idPubli);
        $stmt->bindValue(':idUser', $idUsuario);
        $stmt->bindValue(':cantidad', $cantidad);
        $stmt->execute();
      }
    }
    return 1;
  } else {
    echo "<script>alert('No existe la sesión!');</script>";
  }
}

function almacenarCarritoCompra($id)
{
  session_start(); // Se debe usar antes de tratar de acceder a una variable de sessión
  $idUsuario = $_SESSION['documentoIdentidad'];
  if (!isset($idUsuario)) {
    return 0;
  }
  if ($idUsuario) {
    require('../../../Models/dao/conexion.php');
    // Selecciona los datos que coincidan con el id
    $sql = "CALL sp_getCarritoId(:id)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindValue(":id", $id);
    $consulta->execute();
    $resultado = $consulta->fetchAll();
    $consulta->closeCursor();
    if (@$resultado[0]['id'] == $id) {
      $idPubli = $id;
      $cantidad = 1 + $resultado[0]['cantidad'];
      $sql = "CALL sp_actualizarCarrito(:cantidad, :idPubli,:idUser)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':cantidad', $cantidad);
      $stmt->bindValue(':idPubli', $idPubli);
      $stmt->bindValue(':idUser', $idUsuario);
      $stmt->execute();
      return 1;
    } else {
      $idPubli = $id;
      $cantidad = 1;
      $sql = "CALL sp_almacenarCarrito(:idPubli,:idUser,:cantidad)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':idPubli', $idPubli);
      $stmt->bindValue(':idUser', $idUsuario);
      $stmt->bindValue(':cantidad', $cantidad);
      $stmt->execute();
      return 2;
    }
  }
}

function getCarrito($id)
{
  require('../../../Models/dao/conexion.php');
  $sql = "CALL sp_getCarrito(:id)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":id", $id);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* Clase Check-out con funciones implicadas */

class Checkout
{
  public function getCheckoutInfo()
  {

    require '../../Models/dao/conexion.php';
    session_start();
    $idUsuario = $_SESSION['documentoIdentidad'];
    $sql = "CALL sp_getCheckoutInfo(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $idUsuario);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
  }
  public function getImgCheckoutInfo()
  {
    require '../../Models/dao/conexion.php';
    $idUsuario = $_SESSION['documentoIdentidad'];
    $sql = "CALL sp_getImgCheckoutInfo(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $idUsuario);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $resultado;
  }

  public function validarDireccion()
  {

    session_start();
    $idUsuario = $_SESSION['documentoIdentidad'];
    if (isset($idUsuario)) {
      /* TODO: TENER EN CUENTA AQUELLOS CASOS EN LOS QUE LA VARIABLE NO ESTÉ ASIGNADA*/
      require('../../../Models/dao/conexion.php');
      $sql = "CALL sp_validarDireccion(:id)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":id", $idUsuario);
      $stmt->execute();
      $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC); /* FETCH_ASSOC permite devolver solo un tipo de arreglo, en este caso, asociativo */
      $resultado = json_encode($resultado);
      return $resultado;
    } else {
      $arr = array();
      return $arr;
    }
  }

  public function getCiudades()
  {

    require '../../../Models/dao/conexion.php';
    $sql = "CALL sp_getCiudades()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $resultado = json_encode($resultado);
    return $resultado;
  }
  public function finalizarCompra($direccion, $email)
  {
    /* 
    Nota: Para esta función no se implemetó procedimientos almacenados debido a una incompatibilidad que de momento desconocemos.
    */
    require('../../../Models/dao/conexion.php');
    session_start();
    $idUsuario = $_SESSION['documentoIdentidad'];
    /* Almacenar información de la compra */
    $sqlFa = "INSERT INTO `tblFactura`
      VALUES (null,:idUser,CURRENT_TIMESTAMP,:direccion,:email,0)";
    $stmt = $pdo->prepare($sqlFa);
    $stmt->bindValue(':idUser', $idUsuario);
    $stmt->bindValue(':direccion', $direccion);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $idFactura = $pdo->lastInsertId(); //Regresar el id del último registro insertado
    /* Almacenar información en tabla intermedia tblfacturapublicacion */

    $sqlCa = "SELECT idPublicacionCarrito as 'idPu',
      cantidadCarrito as 'cantidad' 
      FROM tblCarrito
      WHERE docIdentidadCarrito = :idUsuario";
    $stmtCa = $pdo->prepare($sqlCa);
    $stmtCa->bindValue(':idUsuario', $idUsuario);
    $stmtCa->execute();
    $respuesta = $stmtCa->fetchAll(PDO::FETCH_ASSOC);

    foreach ($respuesta as $fila) {


      $idPubli = $fila['idPu'];
      $cantidad = $fila['cantidad'];
      $sqlFacPu = "INSERT INTO tblFacturaPublicacion
        VALUES (:idFact, :idPubli, :cantidad)";
      $stmtFacPu = $pdo->prepare($sqlFacPu);
      $stmtFacPu->bindValue(':idFact', $idFactura);
      $stmtFacPu->bindValue(':idPubli', $idPubli);
      $stmtFacPu->bindValue(':cantidad', $cantidad);
      $stmtFacPu->execute();

      //Restar stock a la publicación
      $sqlStock = "UPDATE tblPublicacion
        SET cantidadPublicacion = (cantidadPublicacion-:cantidad)
        WHERE idPublicacion =:id";
      $stmtStock = $pdo->prepare($sqlStock);
      $stmtStock->bindValue(':cantidad', $cantidad);
      $stmtStock->bindValue(':id', $idPubli);
      $stmtStock->execute();

      /* Eliminar información de la tabla carrito */
      $sqlDeleteCart = "DELETE FROM tblCarrito 
        WHERE idPublicacionCarrito = :idPubli 
        AND docIdentidadCarrito = :idUsuario";
      $stmtDeleteCart = $pdo->prepare($sqlDeleteCart);
      $stmtDeleteCart->bindValue(':idPubli', $idPubli);
      $stmtDeleteCart->bindValue(':idUsuario', $idUsuario);
      $stmtDeleteCart->execute();
    }
    echo "<script>alert('¡Se procesó la compra con éxito :)!');</script>";
    echo "<script> document.location.href='../../../Views/navegacion/index.php';</script>";
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
    require('../../../Models/dao/conexion.php');
    $sql = "CALL sp_facturasCreadas(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    return $stmt->fetchAll();
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
    require('../../../Models/dao/conexion.php');
    $sqlMisCompras = "CALL sp_cuerpoFactura(:id,:numero)";
    $stmt = $pdo->prepare($sqlMisCompras);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":numero", $numero);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  public function EncabezadoFactura($id, $numero)
  {

    require('../../../Models/dao/conexion.php');
    $sql   = "CALL sp_encabezadoFactura(:id,:numero)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":numero", $numero);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
}
