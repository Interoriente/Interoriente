<?php
if (isset($_POST['subir'])) {

    //Captura de imagen
    $directorio = "../imagenes/";

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
                    include_once '../../../../dao/conexion.php';
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['descripcion'];
                    $color = $_POST['color'];
                    $costo = $_POST['costo'];
                    $estadoarticulo = $_POST['estado'];
                    $stock = $_POST['stock'];
                    $categoria = $_POST['categoria'];
                    $usuario = $_POST['usuario'];
                    $verificacion = '0';
                    //sentencia Sql
                    $sql_insertar = "INSERT INTO tblPublicacion (nombrePublicacion,docIdentidad,descripcionPublicacion,colorPublicacion,costoPublicacion,estadoArticulo,stockProducto,categoriaPublicacion,validacionPublicacion)VALUES (?,?,?,?,?,?,?,?,?)";
                    //Preparar consulta
                    $consulta_insertar = $pdo->prepare($sql_insertar);
                    //Ejecutar la sentencia
                    $consulta_insertar->execute(array($nombre, $usuario, $descripcion, $color, $costo, $estadoarticulo, $stock, $categoria, $verificacion));

                    //Llamado idPublicacion
                    $sqlLlamarId = "SELECT MAX(idPublicacion) AS id FROM tblPublicacion";
                    $consultaLlamarId = $pdo->prepare($sqlLlamarId);
                    $consultaLlamarId->execute();
                    $resultado_mostrar_publi1 = $consultaLlamarId->fetch();
                    foreach ($resultado_mostrar_publi1 as $datos) { //Llamado al foreach para convertir el valor a entero
                    }
                    //Insertando imagen en la tabla
                    $sqlInsertarImagen = "INSERT INTO tblImagenes (urlImagen,publicacionImagen)VALUES (?,?)";
                    $consultaInsertar = $pdo->prepare($sqlInsertarImagen);
                    $consultaInsertar->execute(array($archivo, $datos));

                    echo "<script>alert('El registro se subió correctamente');</script>";
                    echo "<script> document.location.href='../crearPubli.php';</script>";
                }
            } else {
                echo "<script>alert('Ocurrió un error');</script>";
                echo "<script> document.location.href='../crearPubli.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Error: el archivo no es una imagen');</script>";
        echo "<script> document.location.href='../crearPubli.php';</script>";
    }
}
