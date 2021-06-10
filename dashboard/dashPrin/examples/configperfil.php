<?php
session_start();

if (isset($_SESSION["emailUsuario"]) or isset($_SESSION["documentoIdentidad"])) {
    $id = $_SESSION["emailUsuario"];
    include_once '../../../dao/conexion.php';
    $sql_validacion = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' AND estadoUsuario= '1'";
    $consulta_resta_validacion = $pdo->prepare($sql_validacion);
    $consulta_resta_validacion->execute();
    $resultado_validacion = $consulta_resta_validacion->rowCount();
    $validacion = $consulta_resta_validacion->fetch(PDO::FETCH_OBJ);
    //Validacion de roles
    if ($resultado_validacion) {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
            <meta name="author" content="Creative Tim">
            <title>Mi perfil - Interoriente</title>
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
            <?php require_once '../assets/sidebar.php' ?>
            <?php require_once '../assets/header.php' ?>
            <?php
            $id = $_SESSION["emailUsuario"];
            include_once '../../../dao/conexion.php';
            $sql_inicio = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' ";
            $consulta_resta = $pdo->prepare($sql_inicio);
            $consulta_resta->execute();
            $resultado = $consulta_resta->rowCount(array($id));
            $resultado2 = $consulta_resta->fetch(PDO::FETCH_OBJ);
            //Validacion de roles
            if ($resultado) {
            ?>
                <!-- Header -->
                <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
                    <!-- Mask -->
                    <span class="mask bg-gradient-default opacity-8"></span>
                    <!-- Header container -->
                    <div class="container-fluid d-flex align-items-center">
                        <div class="row">
                            <div class="col-lg-7 col-md-10">
                                <h1 class="display-2 text-white">Hola! <?php echo $resultado2->nombresUsuario; ?></h1>
                                <a href="#!" class="btn btn-neutral">Editar perfil</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Editar perfil </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="crud/actualizarCuenta.php" method="GET">
                                <h6 class="heading-small text-muted mb-4">Información de usuario</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nombre</label>
                                                <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Username" value="<?php echo $resultado2->nombresUsuario; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Apellido</label>
                                                <input type="text" id="input-username" name="apellido" class="form-control" placeholder="Username" value="<?php echo $resultado2->apellidoUsuario; ?>">
                                            </div>
                                        </div>
                                        <p>Ten en cuenta que si modificas el correo deberás iniciar sesión nuevamente</p>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Correo</label>
                                                <input type="email" id="input-email" name="correo" class="form-control" value="<?php echo $resultado2->emailUsuario; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="ideditar" value="<?php echo $resultado2->documentoIdentidad; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" type="submit" name="subir">Editar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
        echo "<script> document.location.href='403.php';</script>";
    }
} else {
    echo "<script> document.location.href='403.php';</script>";
}
?>