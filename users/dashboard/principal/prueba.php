<?php

if (isset($_FILES['imagen'])) {
    /* include_once '../../../dao/conexion.php';
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

    foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['imagen']['name'][$key]) {
            $filename = $_FILES['imagen']['name'][$key];
            $temporal = $_FILES['imagen']['tmp_name'][$key];

            $directorio = "imagenesPubli/";
            //Crear carpeta si no se tiene
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777);
            }
            $dir = opendir($directorio);
            $ruta = $directorio . $filename;
            if (move_uploaded_file($temporal, $ruta)) {
            } else {
                echo "Error";
            }
            closedir($dir);
        }
    }
    //Si se efectuaron cambios que imprima
    if ($ruta) {
        echo "BIen";
    } else {
        echo "F";
    }
    

    $directorio = "imagenesPubli/$idPubli";
    $archivo = $directorio. basename($_FILES["imagen"]["tmp_name"]);
    $cantidad = count($_FILES["imagen"]["tmp_name"]);
    

    for ($i = 0; $i < $cantidad; $i++) {
        //Comprobamos si el fichero es una imagen
        if ($_FILES['imagen']['type'][$i] == 'image/png' || $_FILES['imagen']['type'][$i] == 'image/jpeg') {

            //Subimos el fichero al servidor
            move_uploaded_file($_FILES["imagen"]["tmp_name"][$i], $archivo[$i]);
           
        } else
            $validar = false;
    }
}
$validar = true;*/

    /* include_once '../../../dao/conexion.php';
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
    //Ejecutar la sentencia
    $consulta_insertar->execute(array($nombre, $usuario, $descripcion, $color, $costo, $estadoarticulo, $stock, $categoria, $verificacion));
    //Llamado idPublicacion
    $sqlLlamarId = "SELECT Max(idPublicacion) FROM tblPublicacion";
    $consultaLlamarId = $pdo->prepare($sqlLlamarId);
    $consultaLlamarId->execute();
    $resultadoLlamarId = $consultaLlamarId->fetch();
    //Se debe utilizar mientras se encuentra una forma más rápida o mejor
    foreach ($resultadoLlamarId as $datos) {
    }
    $datos = $datos;
    $idPubli = "id" . $datos . " ";
    //Captura de imagen
    $directorio = "../imagenesPubli/$idPubli"; */

    foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
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

?>




    <?php /* if (isset($_FILES['imagen']) && $validar == true) {  */ ?>
    <?php /* $cantidad = count($_FILES["imagen"]["tmp_name"]);

    for ($i = 0; $i < $cantidad; $i++) { */ ?>
    <!-- <h1><?php echo $_FILES["imagen"]["name"][$i] ?></h1>
        <img src="<?php echo $_FILES["imagen"]["name"][$i] ?>" width="100"> -->
<?php //}
} ?>