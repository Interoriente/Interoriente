<?php

use phpseclib3\Crypt\RC2;

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
        try {
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
            echo "<script> document.location.href='../../../Views/dashboard/principal/usuarios.php';</script>";
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        }
    }

    public function DesactivarUsuario($id)
    {
        try {
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
            echo "<script> document.location.href='../../../Views/dashboard/principal/usuarios.php';</script>";
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        }
    }

    public function ActualizarCuenta($id)
    {
        try {
            require '../../../Models/dao/conexion.php';
            //Capturo la sesión del usuario logueado
            $celular = $_POST['celular'];
            $correo = $_POST['correo'];
            @$img = $_FILES['file']['name'];
            if (isset($_FILES['file']) && ($img == !NULL)) {
                //Captura de imagen
                $directorio = "../../../Views/dashboard/principal/imagenes/";

                $archivo = $directorio . basename($_FILES['file']['name']);

                //Ruta para almacenar en la base de datos
                $nombreArchivo = "imagenes/" . basename($_FILES['file']['name']);

                $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

                //Validar que es imagen
                $validarImagen = getimagesize($_FILES['file']['tmp_name']);

                //var_dump($size);

                if ($validarImagen != false) {
                    $size = $_FILES['file']['size'];
                    //Validando tamano del archivo
                    if ($size > 70000000) {
                        echo "El archivo excede el limite, debe ser menor de 700kb";
                    } else {
                        if ($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png') {
                            //Se validó el archivo correctamente
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $archivo)) {
                                //sentencia Sql
                                $sql = "CALL sp_actualizarCuentaConImagen (:celular,:correo,:archivo,:id)";
                                //Preparar consulta
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindValue(":celular", $celular);
                                $stmt->bindValue(":correo", $correo);
                                $stmt->bindValue(":archivo", $nombreArchivo);
                                $stmt->bindValue(":id", $id);
                                //Ejecutar la sentencia
                                $stmt->execute();
                                echo "<script>alert('Registro actualizado correctamente');</script>";
                                echo "<script> document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
                            } else {
                                echo "<script>alert('Ocurrió un error');</script>";
                                echo "<script> document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
                            }
                        } else {
                            echo "<script>alert('Error: solo se admiten archivos jpg, png y jpeg');</script>";
                            echo "<script> document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
                        }
                    }
                } else {
                    echo "<script>alert('Error: el archivo no es una imagen');</script>";
                    echo "<script> document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
                }
            } else {
                //Sentencia sql
                $sql = "CALL sp_actualizarCuentaSinImagen(:celular,:correo,:id)";
                //Preparar la consulta
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":celular", $celular);
                $stmt->bindValue(":correo", $correo);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                echo "<script>alert('Datos actualizados correctamente');</script>";
                echo "<script> document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
            }
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        }
    }
    public function AgregarDireccion($id)
    {
        try {
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
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        }
    }
    public function EliminarDireccion($id)
    {
        try {
            require '../../../Models/dao/conexion.php';
            $sql = "CALL sp_eliminarDireccion(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            echo "<script>alert('Dirección eliminada correctamente');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        }
    }
    public function ActualizarDireccion($id)
    {
        try {
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
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
            echo "<script>document.location.href='../../../Views/dashboard/principal/perfil.php';</script>";
        }
    }
}
