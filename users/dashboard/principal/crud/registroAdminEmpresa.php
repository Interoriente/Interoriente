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
    include_once '../../../../dao/conexion.php';
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
                    $celular = strip_tags($_POST['telefono']);
                    $documento = strip_tags($_POST['usuario']);
                    $estado = '0';

                    //sentencia Sql
                    $sqlInsertar = "INSERT INTO tblEmpresa (nitEmpresa,nombreEmpresa, descripcionEmpresa, correoEmpresa,imagenEmpresa, direccionEmpresa,ciudadEmpresa,telefonoEmpresa,estadoEmpresa)VALUES (?,?,?,?,?,?,?,?,?)";
                    //Preparar consulta
                    $consultaInsertar = $pdo->prepare($sqlInsertar);
                    //Ejecutar la sentencia
                    $consultaInsertar->execute(array($nit, $nombre, $descripcion, $correo, $archivo, $direccion, $ciudad, $celular, $estado));

                    echo "<script>alert('Su empresa se registró correctamente');</script>";
                    echo "<script>alert('Debes pasar por proceso de vericación para poder empezar con tu empresa');</script>";
                    echo "<script> document.location.href='../registroAdminEmpresa.php';</script>";
                } else {
                    echo "<script>alert('Ocurrió un error');</script>";
                    echo "<script> document.location.href='../registroAdminEmpresa.php';</script>";
                }
            } else {
                echo "<script>alert('Error: solo se admiten archivos jpg, png y jpeg');</script>";
                echo "<script> document.location.href='../registroAdminEmpresa.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Error: el archivo no es una imagen');</script>";
        echo "<script> document.location.href='../../principal/navegacion/registroEmpresa.php';</script>";
    }
    ?>
</body>


</html>