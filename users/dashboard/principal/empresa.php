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
    $sqlSesionRol = "SELECT * FROM tblUsuarioRol WHERE docIdentidadUsuarioRol=? AND idUsuarioRol=?";
    $consultaSesionRol = $pdo->prepare($sqlSesionRol);
    $consultaSesionRol->execute(array($documento, $sesionRol));
    $resultadoSesionRol = $consultaSesionRol->rowCount();

    //Mostrando roles almacenados
    $sqlRol = "SELECT * FROM tblUsuarioRol INNER JOIN tblRol ON tblUsuarioRol.idUsuarioRol = tblRol.idRol WHERE docIdentidadUsuarioRol=?";
    $consultaRol = $pdo->prepare($sqlRol);
    $consultaRol->execute(array($documento));
    $resultadoRol = $consultaRol->fetchAll();
    //Llamado tabla usuario
    $sqlMostrarConteo = "SELECT*FROM tblUsuario";
    $consultaMostrarConteo = $pdo->prepare($sqlMostrarConteo);
    $consultaMostrarConteo->execute();
    $resultadoMostrarConteo = $consultaMostrarConteo->rowCount();
    //Llamado tabla publicaciones
    $sqlMostrarConteoPubli = "SELECT*FROM tblPublicacion";
    $consultaMostrarConteoPubli = $pdo->prepare($sqlMostrarConteoPubli);
    $consultaMostrarConteoPubli->execute();
    $resultadoMostrarConteoPubli = $consultaMostrarConteoPubli->rowCount();
    //Validacion de roles
    if ($resultado_validacion) {
        if ($resultadoSesionRol) {
            if ($sesionRol == '1' or $sesionRol == '2' or $sesionRol == '3') {
?>
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
                    <meta name="author" content="Inter-oriente">
                    <!-- Favicon -->
                    <link rel="icon" href="../../../assets/img/favicon.png" type="image/png">
                    <!-- Fonts -->
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
                    <!-- Icons -->
                    <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
                    <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
                    <!-- Argon CSS -->
                    <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
                    <title>Empresa - Interoriente</title>
                </head>

                <body>
                    <?php
                    require_once '../assets/sidebarDashboard.php';
                    require_once '../assets/header.php'; ?>
                    <br><br><br><br>
                    <!-- Page content -->
                    <div class="container-fluid mt--6">
                        <div class="row mt--5">
                            <div class="col-md-10 ml-auto mr-auto">
                                <div class="card card-upgrade">
                                    <div class="card-header text-center border-bottom-0">
                                        <h4 class="card-title">Para comenzar a configurar tu empresa</h4>
                                        <h2 class="card-category">Por favor ingresa los empleados y su cargo</h2>
                                        <p class="card-category">Ten en cuenta que el trabajador ya debe tener registrada una cuenta para poder registrarlo</p>
                                    </div>
                                    <div class="card-body">
                                    <form action="" method="post">
                                        <center>
                                        <label for="">Documento empleado:</label><br>
                                        <input type="number" name="documento" id=""><br><br>
                                        <label for="">Cargo:</label><br>
                                        <select name="" id="">
                                            <option value=""></option>
                                        </select><br><br>
                                        <input type="submit" value="Enviar">
                                    </center>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Footer -->
                        <?php require_once '../assets/footer.php' ?>
                </body>

                </html>
<?php
            } else {
                echo "<script>alert('No puedes acceder a esta página con el rol que tienes');</script>";
                echo "<script> document.location.href='dashboard.php';</script>";
            }
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