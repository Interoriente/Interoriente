<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    include_once '../../../../dao/conexion.php';
    //Capturo la sesión del usuario logueado
    $id = $_POST['ideditar'];
    $celular = $_POST['celular'];
    //$ciudad = $_GET['ciudad'];
    $correo = $_POST['correo'];

    $img = $_FILES['file']['name'];
    if (isset($_FILES['file']) && ($img == !NULL)) {
        //Captura de imagen
        $directorio = "imagenes/";

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
                        //sentencia Sql
                        $sql_insertar = "UPDATE tblUsuario SET telefonomovilUsuario=?,emailUsuario=?,imagenUsuario=? WHERE documentoIdentidad=?";
                        //Preparar consulta
                        $consulta_insertar = $pdo->prepare($sql_insertar);
                        //Ejecutar la sentencia
                        $consulta_insertar->execute(array($celular,  $correo, $archivo, $id));
                        echo "<script>alert('Registro actualizado correctamente');</script>";
                        echo "<script> document.location.href='../perfil.php';</script>";
                    } else {
                        echo "<script>alert('Ocurrió un error');</script>";
                        echo "<script> document.location.href='../perfil.php';</script>";
                    }
                } else {
                    echo "<script>alert('Error: solo se admiten archivos jpg, png y jpeg');</script>";
                    echo "<script> document.location.href='../perfil.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Error: el archivo no es una imagen');</script>";
            echo "<script> document.location.href='../perfil.php';</script>";
        }
    } else {
        //Sentencia sql
        $sql_actualizar = "UPDATE tblUsuario SET telefonomovilUsuario=?,emailUsuario=? WHERE documentoIdentidad=?";
        //Preparar la consulta
        $consultar_actualizar = $pdo->prepare($sql_actualizar);
        //Ejecutar

        //Redireccionar
        if ($consultar_actualizar->execute(array($celular,  $correo, $id))) {
            echo "<script>alert('Datos actualizados correctamente');</script>";

            echo "<script> document.location.href='../perfil.php';</script>";
        } else {
            echo "<script>alert('Error!, verifica e intenta nuevamente');</script>";

            echo "<script> document.location.href='../perfil.php';</script>";
        }
    }
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}
