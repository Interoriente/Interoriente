<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creando publicación...</title>
</head>

<body>
    <!--- Codigo subir al servidor--->
    <?php
    //Captura de imagen
    $directorio = "../../imagenes/";
    
    $archivo = $directorio . basename($_FILES['file']['name']);
    $directoryName = basename($_FILES['file']['name']);

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
                    include_once '../../dao/conexion.php';
                    //Var_dump ($_FILES['file']);
                    $titulo = $_POST['titulo'];
                    $descripcion = $_POST['descripcion'];
                    $costo = $_POST['costo'];
                    //sentencia Sql
                    $sql_insertar = "INSERT INTO tblPublicacion (nombrePublicacion,descripcion, imagen, costo)VALUES (?,?,?,?)";
                    //Preparar consulta
                    $consulta_insertar = $pdo->prepare($sql_insertar);
                    //Ejecutar la sentencia
                    $consulta_insertar->execute(array($titulo, $descripcion, $directoryName, $costo));
                    echo "<script>alert('El registro se subió correctamente');</script>";
                    echo "<script> document.location.href='../../dashboard/dashPrin/examples/crearPubli.php';</script>";
                } else {
                    echo "<script>alert('Ocurrió un error');</script>";
                    echo "<script> document.location.href='../../dashboard/dashPrin/examples/crearPubli.php';</script>";
                }
            } else {
                echo "<script>alert('Error: solo se admiten archivos jpg, png y jpeg');</script>";
                echo "<script> document.location.href='../../dashboard/dashPrin/examples/crearPubli.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Error: el archivo no es una imagen');</script>";
        echo "<script> document.location.href='../../dashboard/dashPrin/examples/crearPubli.php';</script>";
    }
    ?>
</body>

</html>