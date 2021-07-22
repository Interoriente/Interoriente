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
                        <div class="card-header text-center border-bottom-0">
                            <h3 class="card-title">Estadisticas de tu empresa</h3>

                            <!-- Card stats -->
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-stats">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Tráfico total</h5>
                                                    <span class="h2 font-weight-bold mb-0">350,897</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                                        <i class="ni ni-active-40"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                                <span class="text-nowrap">Since last month</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-stats">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Usuarios</h5>
                                                    <span class="h2 font-weight-bold mb-0">2,356</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                                        <i class="ni ni-chart-pie-35"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                                <span class="text-nowrap">Since last month</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-stats">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Ventas</h5>
                                                    <span class="h2 font-weight-bold mb-0">924</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                        <i class="ni ni-money-coins"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                                <span class="text-nowrap">Since last month</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-stats">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Aumento</h5>
                                                    <span class="h2 font-weight-bold mb-0">49,65%</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                                        <i class="ni ni-chart-bar-32"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm">
                                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                                <span class="text-nowrap">Since last month</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br>
                    <!-- Page content -->
                    <div class="container-fluid mt--6">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card bg-default">
                                    <div class="card-header bg-transparent">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                                                <h5 class="h3 text-white mb-0">Sales value</h5>
                                            </div>
                                            <div class="col">
                                                <ul class="nav nav-pills justify-content-end">
                                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                                            <span class="d-none d-md-block">Month</span>
                                                            <span class="d-md-none">M</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                                            <span class="d-none d-md-block">Week</span>
                                                            <span class="d-md-none">W</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Chart -->
                                        <div class="chart">
                                            <!-- Chart wrapper -->
                                            <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header bg-transparent">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                                                <h5 class="h3 mb-0">Total orders</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Chart -->
                                        <div class="chart">
                                            <canvas id="chart-bars" class="chart-canvas"></canvas>
                                        </div>
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