<?php
if (isset($_POST['desactivarUsuarios'])) {
    $id = $_POST['id'];
    $administrador = new Administrador($id);
    $administrador->DesactivarUsuario($administrador->id);
} else if (isset($_POST['activarUsuarios'])) {
    $id = $_POST['id'];
    $administrador = new Administrador($id);
    $administrador->ActivarUsuario($administrador->id);
} else if (isset($_POST['actualizarCuenta'])) {
    $id = $_POST['documentoUsuario'];
    $administrador = new Administrador($id);
    $administrador->ActualizarCuenta($administrador->id);
} else if (isset($_POST['agregarDirecciones'])) {
    $id = $_POST['documentoUsuario'];
    $administrador = new Administrador($id);
    $administrador->AgregarDireccion($administrador->id);
} else if (isset($_POST['eliminarDireccion'])) {
    $id = $_POST['idDireccion'];
    $administrador = new Administrador($id);
    $administrador->EliminarDireccion($administrador->id);
} else if (isset($_POST['actualizarDireccion'])) {
    $id = $_POST['idDireccion'];
    $administrador = new Administrador($id);
    $administrador->ActualizarDireccion($administrador->id);
}

class Usuario
{
    /* Atributos */
    public int $docId;

    /* Constructor */
    public function __construct(int $docId)
    {
        $this->id = $docId;
    }
    /* Funciones */
    public function getUserData($docId)
    {
        if (isset($docId)) {
            $sesionRol = $_SESSION['roles'];
            require '../../../model/dao/conexion.php';
            $sqlValidacion = "SELECT *
            FROM tblUsuario AS US
            INNER JOIN tblUsuarioRol AS UR 
            ON UR.docIdentidadUsuarioRol = US.documentoIdentidad
            WHERE US.documentoIdentidad = :id AND US.estadoUsuario = '1'";
            $stmt = $pdo->prepare($sqlValidacion);
            $stmt->bindParam(':id', $docId);
            $stmt->execute();
            $contadorValidacion = $stmt->rowCount();
            if ($contadorValidacion) {
                return $objetoRol = $stmt->fetch(PDO::FETCH_OBJ);
            }
        } else {
            return false;
        }
    }
    public function getDirecciones($docId)
    {
        require '../../../model/dao/conexion.php';
        $sqlDireccion = "SELECT 
          DI.idDireccion, 
          DI.nombreDireccion,
          DI.descripcionDireccion,
          CI.nombreCiudad,
          CI.idCiudad 
          FROM tblDirecciones as DI
          INNER JOIN tblCiudad as CI ON DI.ciudadDireccion = CI.idCiudad
          WHERE docIdentidadDireccion = ?";
        //Prepara sentencia
        $consultarDireccion = $pdo->prepare($sqlDireccion);
        //Ejecutar consulta
        $consultarDireccion->execute(array($docId));
        return $consultarDireccion->fetchAll();
    }
    public function getCiudades()
    {
        require('../../../model/dao/conexion.php');
        $sql = "SELECT idCiudad,
        nombreCiudad 
        FROM tblCiudad ORDER BY nombreCiudad";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getRoles($docId)
    {
        require "../../../model/dao/conexion.php";
        $sql = "SELECT RO.nombreRol, UR.idUsuarioRol
        FROM tblUsuarioRol AS UR
        INNER JOIN tblRol AS RO ON RO.idRol = UR.idUsuarioRol
        WHERE docIdentidadUsuarioRol = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $docId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getUsuarios($docId)
    {
        require "../../../model/dao/conexion.php";
        //Llamar a la conexion base de datos -> Muestro el contenido de tabla usuario
        //Mostrar todos los datos almacenados
        $sql = "SELECT * 
        FROM tblUsuario 
        WHERE documentoIdentidad <> ?";
        //Prepara sentencia
        $stmt = $pdo->prepare($sql);
        //Ejecutar consulta
        $stmt->execute(array($docId));
        return $stmt->fetchAll();
    }
}

class Administrador
{
    public int $id;

    public function __construct($id)
    {
        $this->id = $id;
    }


    public function ActivarUsuario($id)
    {
        //Llamada a la conexion
        require '../../model/dao/conexion.php';
        $estado = '1';
        //sentencia sql para actualizar estado
        $sqlEditar = "UPDATE tblUsuario 
        SET estadoUsuario = ?  
        WHERE documentoIdentidad = ?";
        $consultaEditar = $pdo->prepare($sqlEditar);
        $consultaEditar->execute(array($estado, $id));
        //alert
        echo "<script>alert('Estado actualizado correctamente');</script>";
        //redireccionar
        echo "<script> document.location.href='../../view/dashboard/principal/usuarios.php';</script>";
    }

    public function DesactivarUsuario($id)
    {
        //Llamada a la conexion
        require '../../model/dao/conexion.php';
        $estado = '0';
        //sentencia sql para actualizar estado
        $sqlEditar = "UPDATE tblUsuario 
        SET estadoUsuario = ?  
        WHERE documentoIdentidad = ?";
        $consultaEditar = $pdo->prepare($sqlEditar);
        $consultaEditar->execute(array($estado, $id));
        //alert
        echo "<script>alert('Estado actualizado correctamente');</script>";
        //redireccionar
        echo "<script> document.location.href='../../view/dashboard/principal/usuarios.php';</script>";
    }

    public function ActualizarCuenta($id)
    {
        require '../../model/dao/conexion.php';
        //Capturo la sesión del usuario logueado
        $celular = $_POST['celular'];
        $correo = $_POST['correo'];

        @$img = $_FILES['file']['name'];
        if (isset($_FILES['file']) && ($img == !NULL)) {
            //Captura de imagen
            $directorio = "imagenes/";

            $archivo = $directorio . basename($_FILES['file']['name']);

            $tipo_archivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

            //Validar que es imagen
            $checarsiimagen = getimagesize($_FILES['file']['tmp_name']);

            //var_dump($size);

            if ($checarsiimagen != false) {
                $size = $_FILES['file']['size'];
                //Validando tamano del archivo
                if ($size > 70000000) {
                    echo "El archivo excede el limite, debe ser menor de 700kb";
                } else {
                    if ($tipo_archivo == 'jpg' || $tipo_archivo == 'jpeg' || $tipo_archivo == 'png') {
                        //Se validó el archivo correctamente
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $archivo)) {
                            //sentencia Sql
                            $sql_insertar = "UPDATE tblUsuario SET telefonomovilUsuario=?,emailUsuario=?,imagenUsuario=? WHERE documentoIdentidad=?";
                            //Preparar consulta
                            $consulta_insertar = $pdo->prepare($sql_insertar);
                            //Ejecutar la sentencia
                            $consulta_insertar->execute(array($celular,  $correo, $archivo, $id));
                            echo "<script>alert('Registro actualizado correctamente');</script>";
                            echo "<script> document.location.href='../../view/dashboard/principal/perfil.php';</script>";
                        } else {
                            echo "<script>alert('Ocurrió un error');</script>";
                            echo "<script> document.location.href='../../view/dashboard/principal/perfil.php';</script>";
                        }
                    } else {
                        echo "<script>alert('Error: solo se admiten archivos jpg, png y jpeg');</script>";
                        echo "<script> document.location.href='../../view/dashboard/principal/perfil.php';</script>";
                    }
                }
            } else {
                echo "<script>alert('Error: el archivo no es una imagen');</script>";
                echo "<script> document.location.href='../../view/dashboard/principal/perfil.php';</script>";
            }
        } else {
            //Sentencia sql
            $sql_actualizar = "UPDATE tblUsuario SET telefonomovilUsuario=?,emailUsuario=? WHERE documentoIdentidad=?";
            //Preparar la consulta
            $consultar_actualizar = $pdo->prepare($sql_actualizar);
            //Ejecutar

            //Redireccionar
            if ($consultar_actualizar->execute(array($celular,  $correo, $id))) {
                echo "<script>alert('Datos actualizados correctamente');</script>";

                echo "<script> document.location.href='../../view/dashboard/principal/perfil.php';</script>";
            } else {
                echo "<script>alert('Error!, Verifica e intenta nuevamente');</script>";

                echo "<script> document.location.href='../../view/dashboard/principal/perfil.php';</script>";
            }
        }
    }
    public function AgregarDireccion($id)
    {
        require '../../model/dao/conexion.php';
        @$nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $sqlAgregarDir = "INSERT INTO tblDirecciones 
        (docIdentidadDireccion,nombreDireccion,descripcionDireccion,ciudadDireccion) 
        VALUES (?,?,?,?)";
        $consultaAgregarDir = $pdo->prepare($sqlAgregarDir);
        $consultaAgregarDir->execute(array($id, $nombre, $direccion, $ciudad));
        echo "<script>alert('Dirección almacenada con exito!');</script>";
        echo "<script>document.location.href='../../view/dashboard/principal/perfil.php';</script>";
    }
    public function EliminarDireccion($id)
    {
        require '../../model/dao/conexion.php';
        $sqlEliminarDir = "DELETE FROM tblDirecciones WHERE idDireccion=?";
        $consultaEliminarDir = $pdo->prepare($sqlEliminarDir);
        $consultaEliminarDir->execute(array($id));
        echo "<script>alert('Dirección eliminada correctamente');</script>";
        echo "<script>document.location.href='../../view/dashboard/principal/perfil.php';</script>";
    }
    public function ActualizarDireccion($id)
    {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];

        require '../../model/dao/conexion.php';
        $sqlActualizarDir = "UPDATE tblDirecciones 
        SET nombreDireccion = ?,descripcionDireccion = ?, 
        ciudadDireccion = ? 
        WHERE idDireccion=?";
        $consultaActualizarDir = $pdo->prepare($sqlActualizarDir);
        $consultaActualizarDir->execute(array($nombre, $direccion, $ciudad, $id));
        echo "<script>alert('Dirección actualizada correctamente');</script>";
        echo "<script>document.location.href='../../view/dashboard/principal/perfil.php';</script>";
    }
}
