<?php
session_start();

if (isset($_SESSION["emailUsuario"]) or isset($_SESSION["documentoIdentidad"])) {
    $id = $_SESSION["emailUsuario"];
    $sesionRol = $_SESSION['roles'];
    include_once '../../../dao/conexion.php';
    $sql_validacion = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' AND estadoUsuario= '1'";
    $consulta_resta_validacion = $pdo->prepare($sql_validacion);
    $consulta_resta_validacion->execute();
    $resultado_validacion = $consulta_resta_validacion->rowCount();
    $validacion = $consulta_resta_validacion->fetch(PDO::FETCH_OBJ);
    //Llamado tabla intermedia
    $documento = $_SESSION["documentoIdentidad"];
    $sqlSesionRol = "SELECT * FROM tblUsuarioRol WHERE documentoIdentidad=? AND idRol=?";
    $consultaSesionRol = $pdo->prepare($sqlSesionRol);
    $consultaSesionRol->execute(array($documento, $sesionRol));
    $resultadoSesionRol = $consultaSesionRol->rowCount();
    //Validacion de roles
    if ($resultado_validacion) {
        if ($resultadoSesionRol) {
?>
            <!DOCTYPE html>
            <html>

            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
                <meta name="author" content="Creative Tim">
                <title>Foto de perfil - Interoriente</title>
                <!-- Favicon -->
                <link rel="icon" href="../../../assets/img/favicon.png" type="image/png">
                <!-- Fonts -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
                <!-- Icons -->
                <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
                <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
                <!-- Argon CSS -->
                <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
            </head>

            <body>
                <?php if ($_SESSION['roles'] == '1') {
                    require_once '../assets/sidebarC.php';
                } else if ($_SESSION['roles'] == '2') {
                    require_once '../assets/sidebarV.php';
                } else {
                    require_once '../assets/sidebar.php';
                } ?>
                <?php require_once '../assets/header.php' ?>
                <br>
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Editar foto de perfil </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="configfotoperfil.php" method="POST" enctype="multipart/form-data">
                                <h6 class="heading-small text-muted mb-4">Cambio foto de perfil</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Foto de perfil</label>
                                                <input type="file" id="input-username" name="file" class="form-control-file" placeholder="Imagen" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" type="submit" name="subir">Editar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_POST['subir'])) {

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
                                    include_once '../../../dao/conexion.php';
                                    //Capturo la sesión del usuario logueado
                                    $id = $_SESSION["emailUsuario"];
                                    //sentencia Sql
                                    $sql_insertar = "UPDATE tblUsuario SET imagenUsuario=? WHERE emailUsuario=?";
                                    //Preparar consulta
                                    $consulta_insertar = $pdo->prepare($sql_insertar);
                                    //Ejecutar la sentencia
                                    $consulta_insertar->execute(array($archivo, $id));
                                    echo "<script>alert('Foto de perfil subida y actualizada correctamente');</script>";
                                    echo "<script> document.location.href='perfil.php';</script>";
                                } else {
                                    echo "<script>alert('Ocurrió un error');</script>";
                                }
                            } else {
                                echo "<script>alert('Error: solo se admiten archivos jpg, png y jpeg');</script>";
                            }
                        }
                    } else {
                        echo "<script>alert('Error: el archivo no es una imagen');</script>";
                        echo "<script> document.location.href='crearPubli.php';</script>";
                    }
                }
                ?>
                <!-- Footer -->
                <?php require_once '../assets/footer.php' ?>
                </div>
                <!-- Argon Scripts -->
                <!-- Core -->
                <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
                <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
                <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
                <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
                <!-- Argon JS -->
                <script src="../assets/js/argon.js?v=1.2.0"></script>
            </body>

            </html>
<?php
        } else {
            echo "<script>alert('Has perdido acceso a este rol');</script>";
            echo "<script> document.location.href='403.php';</script>";
        }
    } else {
        echo "<script> document.location.href='403.php';</script>";
    }
} else {
    echo "<script> document.location.href='403.php';</script>";
}
?>