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
  /* Llamado a la base de datos*/
  require('../../Models/dao/conexion.php');
  /* Consulta */

  $sql = "SELECT IMG.urlImagen,PU.idPublicacion,PU.nombrePublicacion,PU.descripcionPublicacion,
          PU.costoPublicacion,PU.stockPublicacion,PU.validacionPublicacion
          FROM tblPublicacion as PU
          INNER JOIN tblImagenes as IMG 
          ON PU.idPublicacion = IMG.publicacionImagen
          WHERE validacionPublicacion='1'
          GROUP BY PU.idPublicacion
          ORDER BY rand()
          LIMIT 30
          ";

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
  $sql = "SELECT idPublicacion as 'id', 
          nombrePublicacion as 'titulo', 
          costoPublicacion as 'costo'
          FROM tblPublicacion 
          WHERE idPublicacion = $id";

  $consulta = $pdo->prepare($sql);
  $consulta->execute();
  $resultado = $consulta->fetchAll(\PDO::FETCH_ASSOC);

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
    require('../../../Models/dao/conexion.php');
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

/* Clase Check-out con funciones implicadas */

class Checkout
{
  public function getCheckoutInfo()
  {
    require '../../Models/dao/conexion.php';
    session_start();
    $idUsuario = $_SESSION['documentoIdentidad'];
    $sql = "SELECT PU.nombrePublicacion AS 'titulo', 
    PU.costoPublicacion AS 'costo', 
    SUM(CA.cantidadCarrito * PU.costoPublicacion) AS 'subtotal', 
    (SUM(CA.cantidadCarrito * PU.costoPublicacion) * 0.19) AS 'iva', 
    (SUM(CA.cantidadCarrito * PU.costoPublicacion) + 
    (SUM(CA.cantidadCarrito * PU.costoPublicacion) * 0.19)) AS 'total'
    FROM tblPublicacion AS PU 
    INNER JOIN tblCarrito AS CA 
    ON PU.idPublicacion = CA.idPublicacionCarrito
    INNER JOIN tblUsuario AS US 
    ON CA.docIdentidadCarrito = US.documentoIdentidad
    WHERE CA.docIdentidadCarrito = $idUsuario
    GROUP BY CA.idPublicacionCarrito";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return $resultado;
  }

  public function validarDireccion()
  {
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
  }

  public function getCiudades()
  {
    require '../../../Models/dao/conexion.php';
    $sql = "SELECT idCiudad as 'id', 
    nombreCiudad as 'nombre' 
    FROM tblCiudad ORDER BY nombreCiudad";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $resultado = json_encode($resultado);
    return $resultado;
  }
  public function finalizarCompra($direccion, $email)
  {
    require('../../../Models/dao/conexion.php');
    session_start();
    $idUsuario = $_SESSION['documentoIdentidad'];
    /* Almacenar información de la compra */
    $sqlFa = "INSERT INTO `tblFactura`
    VALUES (null,:idUser,CURRENT_TIMESTAMP,:direccion,:email)";
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
    WHERE docIdentidadCarrito = $idUsuario";
    $stmtCa = $pdo->prepare($sqlCa);
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
      SET stockPublicacion = (stockPublicacion-$cantidad)
      WHERE idPublicacion =?";
      $stmtStock = $pdo->prepare($sqlStock);
      $stmtStock->execute(array($idPubli));

      /* Eliminar información de la tabla carrito */
      $sqlDeleteCart = "DELETE FROM tblCarrito 
      WHERE idPublicacionCarrito = $idPubli 
      AND docIdentidadCarrito = $idUsuario";
      $stmtDeleteCart = $pdo->prepare($sqlDeleteCart);
      $stmtDeleteCart->execute();
    }
    return "Proceso de Compras Finalizado!!";
  }
}
class Compra
{
  public int $id;

  public function __construct($id)
  {
    $this->id = $id;
  }
  public function misCompras($id)
  {
    require('../../../Models/dao/conexion.php');
    $sqlMisCompras = "SELECT IM.urlImagen,FA.numeroFactura,FA.fechaFactura,
    FA.direccionFactura,FA.emailFactura,
    PU.nombrePublicacion,PU.costoPublicacion,US.telefonomovilUsuario as telefono,
    sum(FP.cantidadFacturaPublicacion) as 'cantidad',
    DATE_FORMAT(FA.fechaFactura, '%d/%m/%Y') as fecha
    FROM tblFactura as FA
    INNER JOIN tblFacturaPublicacion as FP
    ON FP.numFacturaPublicacion=FA.numeroFactura
    INNER JOIN tblPublicacion as PU
    ON PU.idPublicacion=FP.idPublicacionFactura
    INNER JOIN tblUsuario as US
    ON PU.docIdentidadPublicacion=US.documentoIdentidad
    INNER JOIN tblImagenes as IM
    ON IM.publicacionImagen=PU.idPublicacion
    WHERE FA.docIdentidadFactura=?
    GROUP BY PU.idPublicacion";
    $consultaSql = $pdo->prepare($sqlMisCompras);
    $consultaSql->execute(array($id));
    return $consultaSql->fetchAll();
  }
  public function FacturasCreadas($id)
  {
    require('../../../Models/dao/conexion.php');
    $sqlMisCompras = "SELECT FA.numeroFactura,FA.fechaFactura,
    FA.direccionFactura,FA.emailFactura
    FROM tblFactura as FA
    WHERE FA.docIdentidadFactura=?";
    $consultaSql = $pdo->prepare($sqlMisCompras);
    $consultaSql->execute(array($id));
    return $consultaSql->fetchAll();
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
    $sqlMisCompras = "SELECT PU.nombrePublicacion,PU.costoPublicacion,FP.cantidadFacturaPublicacion, FP.cantidadFacturaPublicacion*PU.costoPublicacion as pagar
    FROM tblFactura as FA
    INNER JOIN tblFacturaPublicacion as FP ON FP.numFacturaPublicacion = FA.numeroFactura
    INNER JOIN tblUsuario AS US ON FA.docIdentidadFactura=US.documentoIdentidad
    INNER JOIN tblPublicacion as PU ON PU.idPublicacion=FP.idPublicacionFactura
    WHERE FA.numeroFactura=? AND US.documentoIdentidad=? 
    ORDER BY PU.nombrePublicacion ASC";
    $consultaSql = $pdo->prepare($sqlMisCompras);
    $consultaSql->execute(array($numero, $id));
    return $consultaSql->fetchAll();
  }
  public function EncabezadoFactura($id, $numero)
  {
    require('../../../Models/dao/conexion.php');
    $sqlCliente   = "SELECT US.descripcionUsuario,FA.direccionFactura,
    FA.emailFactura,US.telefonoMovilUsuario,
    FA.numeroFactura,DATE_FORMAT(FA.fechaFactura, '%d/%m/%Y') as fecha, 
    DATE_FORMAT(FA.fechaFactura,'%H:%i:%s') as  hora,
    US.documentoIdentidad,concat(US.nombresUsuario,' ',US.apellidoUsuario) as Cliente 
    FROM tblUsuario AS US
    INNER JOIN tblFactura AS FA ON FA.docIdentidadFactura=US.documentoIdentidad
    WHERE US.documentoIdentidad=? AND FA.numeroFactura=?";
    $prepararCliente = $pdo->prepare($sqlCliente);
    $prepararCliente->execute(array($id, $numero));
    return $prepararCliente->fetch(PDO::FETCH_OBJ);
  }
}
