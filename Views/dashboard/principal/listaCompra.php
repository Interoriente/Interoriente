<?php

/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

// Iniciar variables de sesion, obtener DocId y Rol ACTUAL del usuario
session_start();
$respUserData = null;
if (isset($_SESSION['documentoIdentidad'])) {
    $documento = $_SESSION["documentoIdentidad"];
    $rol = $_SESSION['roles'];
    // Pedir clases Usuarios y Publicaciones (Iniciarlas en variables PHP)
    require "../../../Controllers/php/users/usuarios.php";
    require "../../../Controllers/php/users/compras.php";
    $usuario = new Usuario($documento);
    $respUserData = $usuario->getUserData($usuario->id);

    $compras = new Compra($documento);
    $respMisCompras = $compras->misCompras($compras->id);
    $contadorCompras = count($respMisCompras);
}
//Validar si existe sesión
if (isset($respUserData)) {
    if ($rol == 1) {
        //Parte superior del HTML
        require "../assets/header.php";

        require_once '../assets/sidebarDashboard.php';
        require_once '../assets/navegacion.php';
?>
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Compras realizadas</h6><br>
                            <h6 class="h2 text-white d-inline-block mb-0">Total de facturas generadas: <?php echo $contadorCompras; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0"> </h3>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table id="tabla" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Número</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Dirección</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php
                                    foreach ($respMisCompras as $datosCompra) { ?>
                                        <tr>
                                            <th><?php echo $datosCompra['numeroFactura']; ?></th>
                                            <th><?php echo $datosCompra['fechaFactura']; ?></th>
                                            <th><?php echo $datosCompra['direccionFactura']; ?></th>
                                            <th><?php echo $datosCompra['emailFactura']; ?></th>
                                            <th>
                                                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="verFactura.php?numero=<?php echo $datosCompra['numeroFactura']; ?>" class="btn btn-info" target="_blank">Ver</a>
                                                    <br><br>
                                                    <form action="../../../Controller/php/view/publicaciones.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $datosCompra['numeroFactura']; ?>">
                                                        <button type="submit" class="btn btn-success">Descargar</button>
                                                    </form>
                                                </div>
                                            </th>
                                        </tr>
                                    <?php

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
    <?php require_once '../assets/footer.php';
    } else {
        echo "<script>alert('No puedes acceder a esta página');</script>";
        echo "<script> document.location.href='dashboard.php';</script>";
    }
} else {
    echo "<script>alert('No has iniciado sesión');</script>";
    echo "<script> document.location.href='403.php';</script>";
}
    ?>