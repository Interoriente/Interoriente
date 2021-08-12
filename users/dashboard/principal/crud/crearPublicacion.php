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
    $sql_insertar = "INSERT INTO tblPublicacion (nombrePublicacion,docIdentidadPublicacion,descripcionPublicacion,colorPublicacion,costoPublicacion,estadoArticuloPublicacion,stockPublicacion,categoriaPublicacion,validacionPublicacion)VALUES (?,?,?,?,?,?,?,?,?)";
    //Preparar consulta
    $consulta_insertar = $pdo->prepare($sql_insertar);


    //Llamado idPublicacion
    $sqlLlamarId = "SELECT Max(idPublicacion) FROM tblPublicacion";
    $consultaLlamarId = $pdo->prepare($sqlLlamarId);
    $consultaLlamarId->execute();
    $resultadoLlamarId = $consultaLlamarId->fetch();
    //Se debe utilizar mientras se encuentra una forma más rápida o mejor
    foreach ($resultadoLlamarId as $datos) {
    }
    $datos = $datos + 1;
    $idPubli = "id" . $datos . " ";
    echo $datos;
    //Crear carpetas
    /* if (mkdir($idPubli, 0777, true)) {
        } */
    if (isset($_FILES['imagen'])) {

        $cantidad = count($_FILES["imagen"]["tmp_name"]);
        //Ejecutar la sentencia
        if ($consulta_insertar->execute(array($nombre, $usuario, $descripcion, $color, $costo, $estadoarticulo, $stock, $categoria, $verificacion))) {
            echo "<script>alert('El registro se subió correctamente');</script>";
        }
        for ($i = 0; $i < $cantidad; $i++) {
            //Comprobamos si el fichero es una imagen
            if ($_FILES['imagen']['type'][$i] == 'image/png' || $_FILES['imagen']['type'][$i] == 'image/jpeg' || $_FILES['imagen']['type'][$i] == 'image/jpg') {
                $directorio = "../imagenesPubli/$idPubli";
                $filename = $_FILES['imagen']['name'][$i];
                $temporal = $_FILES['imagen']['tmp_name'][$i];
                $ruta = $directorio . $filename;
                //Subimos el fichero al servidor
                if (move_uploaded_file($temporal, $ruta)) {
                    //Insertando imagen en la tabla
                    $sqlInsertarImagen = "INSERT INTO tblImagenes (urlImagen,publicacionImagen)VALUES (?,?)";
                    $consultaInsertar = $pdo->prepare($sqlInsertarImagen);
                    $consultaInsertar->execute(array($ruta, $datos));
                }
            } else {
                echo "<script>alert('Error: el archivo no es una imagen');</scrip>";
                echo "<script> document.location.href='../crearPubli.php';</script>";
            }
        }
        /* Redirigir después de almacenar la información */
        echo "<script> document.location.href='../crearPubli.php';</script>";
    } else {
        echo "<script>alert('Ocurrió un error');</script>";
        echo "<script> document.location.href='../crearPubli.php';</script>";
    }
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}
