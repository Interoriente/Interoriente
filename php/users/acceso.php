<?php
if (isset($_POST['iniciarSesion']) || isset($_POST['registrarse'])) {
    if (isset($_POST['iniciarSesion'])) {
        $idUsuario = $_POST['id'];
        $contrasena = $_POST['contrasena'];
        $iniciar = new InicioSesion();
        $iniciar->iniciarSesion($idUsuario, $contrasena);
    } else {
        $nombre = strip_tags($_POST['nombres']);
        $apellido = strip_tags($_POST['apellidos']);
        $docIdentidad = strip_tags($_POST['documento']);
        $email = strip_tags($_POST['correo']);
        $contrasena = strip_tags($_POST['contrasena']);
        $contrasenaRepetida = strip_tags($_POST['recontrasena']);
        $registro = new Registro();
        $registro->registrarUsuario($nombre, $apellido, $docIdentidad, $email, $contrasena, $contrasenaRepetida);
    }
}

class Registro
{
    public function registrarUsuario($nombres, $apellidos, $docId, $correo, $pass, $rePass)
    {
        if ($pass == $rePass) {
            //Llamar a la conexion base de datos
            require '../../dao/conexion.php';
            //Verificación si el id ya existe 
            $sqlExistente = "SELECT *
            FROM tblUsuario 
            WHERE emailUsuario = ? OR documentoIdentidad = ?";
            $consultaExistente = $pdo->prepare($sqlExistente);
            $consultaExistente->execute(array($correo, $docId));
            $resultadoExistente = $consultaExistente->rowCount();
            if (!$resultadoExistente) {
                //Sha1 -> Método de encriptación
                $contrasena = sha1($pass);
                $estado = '1';
                $perfil = "imagenes/NO_borrar.png";
                $rol = '1';
                //Consulta correo ingresado no existe en BD
                //sentencia Sql
                $sqlRegistro = "INSERT INTO tblUsuario 
                (documentoIdentidad,nombresUsuario, apellidoUsuario, 
                emailUsuario,contrasenaUsuario,estadoUsuario,imagenUsuario)
                VALUES (?,?,?,?,?,?,?)";
                //Preparar consulta
                $consultaRegistro = $pdo->prepare($sqlRegistro);
                //Ejecutar la sentencia
                $consultaRegistro->execute(array($docId, $nombres, $apellidos, $correo, $pass,  $estado, $perfil));
                //llamado a la tabla rol (intermedia) para almacenar el rol predeterminado
                $sqlRegistroUR = "INSERT INTO tblUsuarioRol 
                (idUsuarioRol,docIdentidadUsuarioRol)VALUES (?,?)";
                //Preparar consulta
                $consultaRegistroUR = $pdo->prepare($sqlRegistroUR);
                //Ejecutar la sentencia
                $consultaRegistroUR->execute(array($rol, $docId));
                /* Almacenado documento de identidad en variable de sesión
                   Creación de la sesión */
                session_start();
                $_SESSION['roles'] = '1';
                $_SESSION["documentoIdentidad"] = $docId;
                //Comprador/Proveedor
                echo "<script> document.location.href='../../users/dashboard/principal/dashboard.php';</script>";
            } else {
                //Impresión correo ingresado, ya existe en BD
                echo "<script>alert('¡El correo y/o número de documento ingresado ya existen! Por favor verifícalos e intenta nuevamente.');</script>";
                echo "<script> document.location.href='../../principal/navegacion/registro.php';</script>";
            }
        } else {
            echo "<script>alert('¡Error! Las contraseñas ingresadas no coinciden, verifica e intenta nuevamente.');</script>";
            echo "<script> document.location.href='../../principal/navegacion/registro.php';</script>";
        }
    }
}

class InicioSesion
{

    public function IniciarSesion($idUsuario, $clave)
    {
        require "../../dao/conexion.php";
        //Capturo información
        $id = strip_tags($idUsuario);
        $contrasena = sha1(strip_tags($clave));
        $estado = '1';
        $sql = "SELECT documentoIdentidad
        FROM tblUsuario 
        WHERE (documentoIdentidad = ? OR emailUsuario = ?)  
        AND contrasenaUsuario = ? AND estadoUsuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($id, $id, $contrasena, $estado));
        $resultado = $stmt->rowCount();
        if ($resultado) {
            if ($dataUsuario = $stmt->fetch(PDO::FETCH_OBJ)) {
                //Llamado al documento independiente si ingresa correo o documento
                $documento = $dataUsuario->documentoIdentidad;
            }
            /* Selecciona el rol del usuario que está intentando iniciar sesión */
            $sqlUsuarioRol = "SELECT idUsuarioRol 
            FROM tblUsuarioRol 
            WHERE docIdentidadUsuarioRol = ?";
            $stmtUsuarioRol = $pdo->prepare($sqlUsuarioRol);
            $stmtUsuarioRol->execute(array($documento));
            $resultadoUsuarioRol = $stmtUsuarioRol->rowCount();
            /* En caso de que el usuario tenga rol o roles asociados */
            if ($resultadoUsuarioRol) {
                session_start();
                $rol = $stmtUsuarioRol->fetch(PDO::FETCH_OBJ);
                $rol = $rol->idUsuarioRol;
                $_SESSION["documentoIdentidad"] = $documento;
                //Siempre para iniciar se inicia como Comprador/Proveedor -> O por lo menos con el primer rol que se tenga
                $_SESSION['roles'] = $rol;
                //Comprador/Proveedor
                header("Location: ../../users/dashboard/principal/dashboard.php");
            }
        } else {
            echo "<script>alert('Correo o documento y/o contraseña incorrecto, o validación denegada');</script>";
            echo "<script> document.location.href='../../principal/navegacion/iniciarsesion.php';</script>";
        }
    }
}
