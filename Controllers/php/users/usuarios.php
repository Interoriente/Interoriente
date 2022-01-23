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
} else if (isset($_POST['cerrarSesion'])) {
    CerrarSesion();
}
function CerrarSesion()
{
    session_start(); //Se necesita para que el session_destroy funciona, de lo contrario no se destrirá la sesión.
    session_destroy();
    echo "<script> document.location.href='../../../Views/navegacion/index.php';</script>";
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
        try {
            require '../../../Models/dao/conexion.php';
            $sqlValidacion = "CALL sp_getUserData(:id)";
            $stmt = $pdo->prepare($sqlValidacion);
            $stmt->bindParam(':id', $docId);
            $stmt->execute();
            $contadorValidacion = $stmt->rowCount();
            if ($contadorValidacion) {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
        } catch (\Throwable $th) {
            //throw $th;
            /* echo "<script>alert('Ocurrió un error');</script>"; */
            echo "<script>document.location.href='../../../Views/dashboard/principal/dashboard.php';</script>";
        }
    }
    public function getDirecciones($docId)
    {
        try {
            require '../../../Models/dao/conexion.php';
            $sqlDireccion = "CALL sp_getDirecciones(:id)";
            //Prepara sentencia
            $consultarDireccion = $pdo->prepare($sqlDireccion);
            $consultarDireccion->bindValue(":id", $docId);
            //Ejecutar consulta
            $consultarDireccion->execute();
            return $consultarDireccion->fetchAll();
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        }
    }
    public function getCiudades()
    {
        try {
            require('../../../Models/dao/conexion.php');
            $sql = "CALL sp_getCiudades";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/dashboard.php';</script>";
        }
    }

    public function getRoles($docId)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_getRoles(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $docId);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/dashboard.php';</script>";
        }
    }
    public function getUsuarios($docId)
    {
        try {

            require "../../../Models/dao/conexion.php";
            //Llamar a la conexion base de datos -> Muestro el contenido de tabla usuario
            //Mostrar todos los datos almacenados
            $sql = "CALL sp_getUsuarios(:id)";
            //Prepara sentencia
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $docId);
            //Ejecutar consulta
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        }
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
        require '../../../Models/dao/conexion.php';
        $estado = '1';
        //sentencia sql para actualizar estado
        $sql = "CALL sp_activarUsuario(:id,:estado)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":estado", $estado);
        $stmt->execute();

        //alert
        echo "<script>alert('Estado actualizado correctamente');</script>";
        //redireccionar
        echo "<script> document.location.href='../../../Views/dashboard/principal/listaAdmin.php';</script>";
    }

    public function DesactivarUsuario($id)
    {
        //Llamada a la conexion
        require '../../../Models/dao/conexion.php';
        $estado = '0';
        //sentencia sql para actualizar estado
        $sql = "CALL sp_desactivarUsuario(:id,:estado)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":estado", $estado);
        $stmt->execute();
        //alert
        echo "<script>alert('Estado actualizado correctamente');</script>";
        //redireccionar
        echo "<script> document.location.href='../../../Views/dashboard/principal/listaAdmin.php';</script>";
    }

    public function ActualizarCuenta($id)
    {
        session_start();
        require '../../../Models/dao/conexion.php';
        /* Captura de información */
        $celular = $_POST['celular'];
        $correo = $_POST['correo'];
        $nombreArchivo = $_POST['imagenActual'];
        /* Si se ingresó imagen */
        if (!empty($_FILES['archivo']['name'])) {
            /* Capturo la extensión del archivo */
            $ruta = $_FILES['archivo']['name'];
            //Trae la extensión del archivo ingresado
            $tipoArchivo = strtolower(pathinfo($ruta, PATHINFO_EXTENSION));
            /* Si el archivo es una imagen... */
            if ($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png') {
                $destino = "../../../Views/dashboard/principal/imagenes/";
                $destino = $destino . basename($_FILES['archivo']['name']);
                $archivoTmp = $_FILES['archivo']['tmp_name'];
                move_uploaded_file($archivoTmp, $destino);
                //Ruta para almacenar en la base de datos
                $nombreArchivo = "imagenes/" . basename($_FILES['archivo']['name']);
            } else {
                echo "<script>alert('Error: solo se admiten archivos jpg, png y jpeg');</script>";
                /* Redirigir a un archivo diferente basado en la condición */
                if ($_SESSION['roles'] == 1) {
                    echo "<script> document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
                } else {
                    echo "<script> document.location.href='../../../Views/dashboard/principal/perfilAdmin.php';</script>";
                }
                /* Devuélvame cuando el tipo de archivo sea inválido */
                return false;
            }
        }
        //Sentencia Sql
        $sql = "CALL sp_actualizarCuenta (:celular,:correo,:archivo,:id)";
        //Preparar consulta
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":celular", $celular);
        $stmt->bindValue(":correo", $correo);
        $stmt->bindValue(":archivo", $nombreArchivo);
        $stmt->bindValue(":id", $id);
        //Ejecutar la sentencia
        $stmt->execute();
        echo "<script>alert('Registro actualizado correctamente');</script>";
        if ($_SESSION['roles'] == 1) {
            echo "<script> document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        } else {
            echo "<script> document.location.href='../../../Views/dashboard/principal/perfilAdmin.php';</script>";
        }
    }
    public function AgregarDireccion($id)
    {
        require '../../../Models/dao/conexion.php';
        @$nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $sql = "CALL sp_agregarDireccion(:id,:nombre,:direccion,:ciudad)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":nombre", $nombre);
        $stmt->bindValue(":direccion", $direccion);
        $stmt->bindValue(":ciudad", $ciudad);
        $stmt->execute();
        echo "<script>alert('Dirección almacenada con éxito!');</script>";
        echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
    }
    public function EliminarDireccion($id)
    {
        require '../../../Models/dao/conexion.php';
        $sql = "CALL sp_eliminarDireccion(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        echo "<script>alert('Dirección eliminada correctamente');</script>";
        echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
    }
    public function ActualizarDireccion($id)
    {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        require '../../../Models/dao/conexion.php';
        $sql = "CALL sp_actualizarDireccion(:nombre,:direccion,:ciudad,:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":nombre", $nombre);
        $stmt->bindValue(":direccion", $direccion);
        $stmt->bindValue(":ciudad", $ciudad);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        echo "<script>alert('Dirección actualizada correctamente');</script>";
        echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
    }
    public function getAdministradores()
    {
        require '../../../Models/dao/conexion.php';
        $sql = "CALL sp_mostrarAdministradores()";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
