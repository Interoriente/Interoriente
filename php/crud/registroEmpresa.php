<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validando información...</title>
</head>

<body>
    <?php
    //Llamar a la conexion base de datos
    include_once '../../dao/conexion.php';
    //Verifico que el documento si esté registrado
    $documento = $_POST['documento'];
    $sqlMostrarDocumento = "SELECT * FROM tblUsuario WHERE documentoIdentidad =?";
    $consultaMostrarDocumento = $pdo->prepare($sqlMostrarDocumento);
    $consultaMostrarDocumento->execute(array($documento));
    $resultadoMostrarDocumento = $consultaMostrarDocumento->rowCount();
    if ($resultadoMostrarDocumento) {
        //Valido que sólo me ingrese una vez el mismo documento
        $sqlMostrarDocumentoUsuarioRol = "SELECT * FROM tblEmpresa WHERE documentoIdentidad =?";
        $consultaMostrarDocumentoUsuario = $pdo->prepare($sqlMostrarDocumentoUsuarioRol);
        $consultaMostrarDocumentoUsuario->execute(array($documento));
        $resultadoMostrarDocumentoUsuario = $consultaMostrarDocumentoUsuario->rowCount();
        if (!$resultadoMostrarDocumentoUsuario) {
            //Captura de imagen
            $directorio = "imagenEmpresa/";

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
                    if ($tipo_archivo == 'jpg' || $tipo_archivo == 'jpeg' || $tipo_archivo == 'png' || $tipo_archivo == 'svg' || $tipo_archivo == 'ico') {
                        //Se validó el archivo correctamente
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $archivo)) {

                            //Capturo información
                            $nit = strip_tags($_POST['nit']);
                            $nombre = strip_tags($_POST['nombre']);
                            $descripcion = strip_tags($_POST['descripcion']);
                            $correo = strip_tags($_POST['correo']);
                            $direccion = strip_tags($_POST['direccion']);
                            $ciudad = strip_tags($_POST['ciudad']);
                            $celular = strip_tags($_POST['celular']);
                            $documento = strip_tags($_POST['documento']);
                            $estado = '0';

                            //sentencia Sql
                            $sqlInsertar = "INSERT INTO tblEmpresa (nitEmpresa,nombreEmpresa, descripcionEmpresa, correoEmpresa,imagenEmpresa, direccionEmpresa,ciudadEmpresa,telefonoEmpresa,estadoEmpresa,documentoIdentidad)VALUES (?,?,?,?,?,?,?,?,?,?)";
                            //Preparar consulta
                            $consultaInsertar = $pdo->prepare($sqlInsertar);
                            //Ejecutar la sentencia
                            $consultaInsertar->execute(array($nit, $nombre, $descripcion, $correo, $archivo, $direccion, $ciudad, $celular, $estado, $documento));

                            echo "<script>alert('Datos almacenados correctamente');</script>";
                            echo "<script> document.location.href='../../principal/navegacion/iniciarsesion.php';</script>";
                        } else {
                            echo "<script>alert('Ocurrió un error');</script>";
                            echo "<script> document.location.href='../../principal/navegacion/registroEmpresa.php';</script>";
                        }
                    } else {
                        echo "<script>alert('Error: solo se admiten archivos jpg, png y jpeg');</script>";
                        echo "<script> document.location.href='../../principal/navegacion/registroEmpresa.php';</script>";
                    }
                }
            } else {
                echo "<script>alert('Error: el archivo no es una imagen');</script>";
                echo "<script> document.location.href='../../principal/navegacion/registroEmpresa.php';</script>";
            }
        } else {
            echo "<script>alert('Error: ya está registrado el documento en una empresa');</script>";
            echo "<script> document.location.href='../../principal/navegacion/registroEmpresa.php';</script>";
        }
    } else {
        echo "<script>alert('Error: No está registrado el documento de identidad');</script>";
        echo "<script> document.location.href='../../principal/navegacion/registroEmpresa.php';</script>";
    }


    ?>
</body>


</html>