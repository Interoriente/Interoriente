<?php
if (isset($_FILES['imagen'])) {
    /* Almacenando información del formulario crear publicacion */
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
    $sql_insertar = "INSERT INTO tblPublicacion 
    (nombrePublicacion,docIdentidadPublicacion,descripcionPublicacion,colorPublicacion,costoPublicacion,estadoArticuloPublicacion,stockPublicacion,categoriaPublicacion,validacionPublicacion)
    VALUES (?,?,?,?,?,?,?,?,?)";
    //Preparar consulta
    $consulta_insertar = $pdo->prepare($sql_insertar);
    //Almaceno información
    $consulta_insertar->execute(array($nombre, $usuario, $descripcion, $color, $costo, $estadoarticulo, $stock, $categoria, $verificacion));

    //Seleccionar último id en la BD
    $datos = ($pdo->lastInsertId());
    $idPubli = "id" . $datos . " ";
    //Crear carpetas
    /* if (mkdir($idPubli, 0777, true)) {
        } */
    $cantidad = count($_FILES['imagen']['tmp_name']);
    //Ejecutar la sentencia
    for ($i = 0; $i < $cantidad; $i++) {
        //Comprobamos si el fichero es una imagen
        if ($_FILES['imagen']['type'][$i] == 'image/png' || $_FILES['imagen']['type'][$i] == 'image/jpeg' || $_FILES['imagen']['type'][$i] == 'image/jpg') {
            //Le defino una ruta a la imagen
            $directorio = "../../../../imagenesPubli/$idPubli";
            //Nombre de la imagen
            $filename = $_FILES['imagen']['name'][$i];
            //Nombre temporal de la imagen -> Por defecto se necesita este paso.
            $temporal = $_FILES['imagen']['tmp_name'][$i];
            $ruta = $directorio . "" .basename($filename);
            //Especifico el nombre que se va a guardar en la BD
            $archivo = $idPubli . "" . $filename;
            //Subimos la imagen al servidor
            if (move_uploaded_file($temporal, $ruta)) {
                //Insertando imagen en la tabla
                $sqlInsertarImagen = "INSERT INTO tblImagenes (urlImagen,publicacionImagen)
                    VALUES (?,?)";
                $consultaInsertar = $pdo->prepare($sqlInsertarImagen);
                $consultaInsertar->execute(array($archivo, $datos));
            }
        } else {
            echo "<script>alert('Error: el archivo no es una imagen');</script>";
            echo "<script> document.location.href='../crearPubli.php';</script>";
        }
    }
    if ($consultaInsertar->execute(array($archivo, $datos))) {
        echo "<script>alert('El registro se subió correctamente');</script>";
        /* Redirigir después de almacenar la información */
        echo "<script> document.location.href='../crearPubli.php';</script>";
    }
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}
