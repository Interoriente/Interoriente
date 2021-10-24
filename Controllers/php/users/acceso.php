<?php
if (isset($_POST['iniciarSesion']) || isset($_POST['registrarse']) || isset($_GET['comprobandoAcceso']) || isset($_POST['registrarAdmin'])) {
    @$logiGoogle = $_GET['comprobandoAcceso'];
    if (isset($_POST['iniciarSesion'])) {
        $idUsuario = $_POST['id'];
        $contrasena = $_POST['contrasena'];
        $iniciar = new InicioSesion();
        $iniciar->iniciarSesion($idUsuario, $contrasena);
    } else if ($logiGoogle) {
        $loginGoogle = new InicioSesion();
        $loginGoogle->LoginGoogle();
    } elseif (isset($_POST['registrarAdmin'])) {
        //Capturo información para registro admin
        $nombre = strip_tags($_POST['nombres']);
        $apellido = strip_tags($_POST['apellidos']);
        $docIdentidad = strip_tags($_POST['documento']);
        $email = strip_tags($_POST['correo']);
        $contrasena = strip_tags($_POST['contrasena']);
        $perfil = strip_tags($_POST['imagen']);
        $registro = new Registro();
        $registro->RegistrarAdmin($docIdentidad, $nombre, $apellido, $email, $contrasena, $perfil);
    } else {
        //Capturo información para registro usuario
        $nombre = strip_tags($_POST['nombres']);
        $apellido = strip_tags($_POST['apellidos']);
        $docIdentidad = strip_tags($_POST['documento']);
        $email = strip_tags($_POST['correo']);
        $contrasena = strip_tags($_POST['contrasena']);
        $perfil = strip_tags($_POST['imagen']);
        $registro = new Registro();
        $registro->registrarUsuario($docIdentidad, $nombre, $apellido, $email, $contrasena, $perfil);
    }
}

class Registro
{
    public function registrarUsuario($docId, $nombres, $apellidos,  $correo, $pass, $imagen)
    {
        try {
            //Llamar a la conexion base de datos
            require '../../../Models/dao/conexion.php';
            //Verificación si el id ya existe 
            $sqlExistente = "CALL sp_validacionCorreoDocumento(:correo,:id)";
            $consultaExistente = $pdo->prepare($sqlExistente);
            $consultaExistente->bindValue(":correo", $correo);
            $consultaExistente->bindValue(":id", $docId);
            $consultaExistente->execute();
            $resultadoExistente = $consultaExistente->rowCount();
            if (!$resultadoExistente) {
                //Sha1 -> Método de encriptación
                $contrasena = sha1($pass);
                $estado = '1';
                $perfil = $imagen;
                $rol = '1';
                //Consulta correo ingresado no existe en BD
                //sentencia Sql
                $sqlRegistro = "CALL sp_registrarUsuario (:id,:nombre,:apellido,
                    :correo,:contrasena,:estado,:imagen)";
                //Preparar consulta
                $consultaRegistro = $pdo->prepare($sqlRegistro);
                $consultaRegistro->bindValue(":id", $docId);
                $consultaRegistro->bindValue(":nombre", $nombres);
                $consultaRegistro->bindValue(":apellido", $apellidos);
                $consultaRegistro->bindValue(":correo", $correo);
                $consultaRegistro->bindValue(":contrasena", $contrasena);
                $consultaRegistro->bindValue(":estado", $estado);
                $consultaRegistro->bindValue(":imagen", $perfil);
                $consultaRegistro->closeCursor();
                //Ejecutar la sentencia
                $consultaRegistro->execute();
                //llamado a la tabla rol (intermedia) para almacenar el rol predeterminado
                $sqlRegistroUR = "CALL sp_guardarRol (:rol,:id)";
                //Preparar consulta
                $consultaRegistroUR = $pdo->prepare($sqlRegistroUR);
                $consultaRegistroUR->bindValue(":rol", $rol);
                $consultaRegistroUR->bindValue(":id", $docId);
                $consultaRegistroUR->closeCursor();
                //Ejecutar la sentencia
                $consultaRegistroUR->execute();
                /* Almacenado documento de identidad en variable de sesión
                    Creación de la sesión */
                session_start();
                $_SESSION['roles'] = '1';
                $_SESSION["documentoIdentidad"] = $docId;
                //Comprador/Proveedor
                echo "<script> document.location.href='../../../Views/dashboard/principal/dashboard.php';</script>";
            } else {
                //Impresión correo ingresado, ya existe en BD
                echo "<script>alert('¡El correo y/o número de documento ingresado ya existen! Por favor verifícalos e intenta nuevamente.');</script>";
                echo "<script> document.location.href='../../../Views/navegacion/registro.php';</script>";
            }
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function RegistrarAdmin($docId, $nombres, $apellidos,  $correo, $pass, $imagen)
    {
        try {
            //Llamar a la conexion base de datos
            require '../../../Models/dao/conexion.php';
            //Verificación si el id ya existe 
            $sqlExistente = "CALL sp_validacionCorreoDocumento(:correo,:id)";
            $consultaExistente = $pdo->prepare($sqlExistente);
            $consultaExistente->bindValue(":correo", $correo);
            $consultaExistente->bindValue(":id", $docId);
            $consultaExistente->execute();
            $resultadoExistente = $consultaExistente->rowCount();
            if (!$resultadoExistente) {
                //Sha1 -> Método de encriptación
                $contrasena = sha1($pass);
                $estado = '1';
                $perfil = $imagen;
                $rol = '3';
                //Consulta correo ingresado no existe en BD
                //sentencia Sql
                $sqlRegistro = "CALL sp_registrarUsuario (:id,:nombre,:apellido,
                    :correo,:contrasena,:estado,:imagen)";
                //Preparar consulta
                $consultaRegistro = $pdo->prepare($sqlRegistro);
                $consultaRegistro->bindValue(":id", $docId);
                $consultaRegistro->bindValue(":nombre", $nombres);
                $consultaRegistro->bindValue(":apellido", $apellidos);
                $consultaRegistro->bindValue(":correo", $correo);
                $consultaRegistro->bindValue(":contrasena", $contrasena);
                $consultaRegistro->bindValue(":estado", $estado);
                $consultaRegistro->bindValue(":imagen", $perfil);
                $consultaRegistro->closeCursor();
                //Ejecutar la sentencia
                $consultaRegistro->execute();
                //llamado a la tabla rol (intermedia) para almacenar el rol predeterminado
                $sqlRegistroUR = "CALL sp_guardarRol (:rol,:id)";
                //Preparar consulta
                $consultaRegistroUR = $pdo->prepare($sqlRegistroUR);
                $consultaRegistroUR->bindValue(":rol", $rol);
                $consultaRegistroUR->bindValue(":id", $docId);
                $consultaRegistroUR->closeCursor();
                //Ejecutar la sentencia
                $consultaRegistroUR->execute();
                //Impresión cuenta creada correctamente
                echo "<script>alert('¡El nuevo administrador se ha registrado con éxito!');</script>";
                echo "<script> document.location.href='../../../Views/dashboard/principal/registrarAdmin.php';</script>";
            } else {
                //Impresión correo ingresado, ya existe en BD
                echo "<script>alert('¡El correo y/o número de documento ingresado ya existen! Por favor verifícalos e intenta nuevamente.');</script>";
                echo "<script> document.location.href='../../../Views/dashboard/principal/registrarAdmin.php';</script>";
            }
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
}

class InicioSesion
{
    public function IniciarSesion($idUsuario, $clave)
    {
        try {
            require "../../../Models/dao/conexion.php";
            //Capturo información
            $id = strip_tags($idUsuario);
            $contrasena = sha1(strip_tags($clave));
            $estado = '1';
            $sql = "CALL sp_iniciarSesion(:id,:contrasena,:estado)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":contrasena", $contrasena);
            $stmt->bindValue(":estado", $estado);
            $stmt->execute();
            $resultado = $stmt->rowCount();
            if ($resultado) {
                if ($dataUsuario = $stmt->fetch(PDO::FETCH_OBJ)) {
                    //Llamado al documento independiente si ingresa correo o documento
                    $documento = $dataUsuario->documentoIdentidad;
                }
                $stmt->closeCursor();
                /* Selecciona el rol del usuario que está intentando iniciar sesión */
                $sqlUsuarioRol = "CALL sp_rolUsuario (:id)";
                $stmtUsuarioRol = $pdo->prepare($sqlUsuarioRol);
                $stmtUsuarioRol->bindValue(":id", $documento);
                $stmtUsuarioRol->execute();
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
                    if ($_SESSION['roles'] == 1) {
                        echo "<script> document.location.href='../../../Views/dashboard/principal/dashboard.php';</script>";
                    } else {
                        echo "<script> document.location.href='../../../Views/dashboard/principal/dashboardAdmin.php';</script>";
                    }
                }
            } else {
                echo "<script>alert('Correo o documento y/o contraseña incorrecto, o validación denegada');</script>";
                echo "<script> document.location.href='../../../Views/navegacion/iniciarsesion.php';</script>";
            }
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
            print "Error! " . $th->getMessage();
        }
    }
    public function LoginGoogle()
    {
        try {
            session_start();
            require_once '../../logingoogle/vendor/autoload.php';

            require_once '../../logingoogle/config.php';

            $client = new Google_Client();

            $client->setClientId($clientID);

            $client->setClientSecret($clientSecret);

            $client->setRedirectUri($redirectUri);

            $client->addScope("email");

            $client->addScope("profile");

            if (isset($_GET['code'])) {

                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

                $client->setAccessToken($token['access_token']);

                // get profile info

                $google_oauth = new Google_Service_Oauth2($client);

                $google_account_info = $google_oauth->userinfo->get();
                // INFORMACION CAPTURADA EN VARIABLES PHP
                $email =  $google_account_info->email;
                $familyName =  $google_account_info->familyName;
                $picture =  $google_account_info->picture;
                $givenName =  $google_account_info->givenName;
                /* FIN Codigo de Google*/
                require_once '../../../Models/dao/conexion.php';
                // Consulta SQL para obtener TODOS los datos del Usuario, incluyendo el rol conociendo su Email (dado por google)
                $sqlInicio = "CALL sp_loginGoogle(:correo)";
                $consultaInicio = $pdo->prepare($sqlInicio);
                $consultaInicio->bindValue(":correo", $email);
                $consultaInicio->execute();
                // RowCount para saber si realmente, EXISTE algun usuario
                $resultadoInicio = $consultaInicio->rowCount();
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $givenName;
                $_SESSION['familyName'] = $familyName;
                $_SESSION['picture'] = $picture;
                if ($resultadoInicio == 0) {
                    echo "<script> document.location.href='../../../Views/navegacion/registroGoogle.php';</script>";
                } else {

                    // Fetch para OBTENER todos los datos en una variable php
                    $resultadoObjetoInicio = $consultaInicio->fetch(PDO::FETCH_OBJ);
                    //Condicional para INICIAR SESION SEGUN ROWCOUNT

                    $documento = $resultadoObjetoInicio->documentoIdentidad;
                    $rol = $resultadoObjetoInicio->idUsuarioRol;

                    $_SESSION["documentoIdentidad"] = $documento;
                    //Siempre para iniciar se inicia como Comprador/Proveedor -> O por lo menos con el primer rol que se tenga
                    $_SESSION['roles'] = $rol;
                    //Comprador/Proveedor
                    header("Location: ../../../Views/dashboard/principal/dashboard.php");
                }
            }
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
}
