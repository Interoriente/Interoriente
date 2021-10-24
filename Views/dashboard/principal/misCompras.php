<?php
// Iniciar variables de sesion, obtener DocId y Rol ACTUAL del usuario
session_start();
if (!isset($_SESSION['documentoIdentidad'])) {
    echo "<script>alert('No has iniciado sesión');</script>";
    echo "<script> document.location.href='403.php';</script>";
} else {
    $documento = $_SESSION["documentoIdentidad"];
    $rol = $_SESSION['roles'];
    // Pedir clases Usuarios y Publicaciones (Iniciarlas en variables PHP)
    require "../../../Controllers/php/users/usuarios.php";
    $usuario = new Usuario($documento);
    $respUserData = $usuario->getUserData($usuario->id);
    require "../../../Controllers/php/users/compras.php";
    $compra = new Compra($documento);

    $respFactura = $compra->FacturasCreadas($compra->id);
    $contadorFactura = count($respFactura);
    if (isset($respUserData)) {
        if ($rol == 1 or $rol == 3) {

            //Parte superior del HTML
            require "../includes/header.php";

            require_once '../includes/sidebarDashboard.php';
            require_once '../includes/navegacion.php'; ?>

            <!-- Link estilos -->
            <link rel="stylesheet" href="../../assets/css/general.css">
            <link rel="stylesheet" href="../assets/css/misCompras.css">
            <!-- Header -->
            <div class="header bg-primary pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-3">
                            <div class="col-lg-6 col-7">
                                <h6 class="h2 text-white d-inline-block mb-0">Facturas generadas</h6><br>
                            </div>
                            <?php if (isset($_POST['numero'])) { ?>
                                <form action="verFactura.php" method="post" target="_blank">
                                    <input type="hidden" name="numero" value="<?php echo $_POST['numero']; ?>">
                                    <button type="submit" class="btn btn-sm btn-neutral cambioRol" name="cambioRol">Ver</button>
                                </form>
                                <button type="submit" class="btn btn-sm btn-neutral cambioRol" name="cambioRol" onclick="print()">Descargar</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Productos comprados -->
            <?php if (!isset($_POST['numero'])) {

                if ($contadorFactura == 0) { ?>
                    <div class="campo-alerta">
                        <div class="alerta" role="alert">Opps, por ahora no has realizado compras
                            <h2 class="titulo-alerta">Para realizar una compra presiona <a class="link-mensaje" href="../../navegacion/catalogos.php">aquí</a></h2>
                            <img class="img-caja" src="../assets/img/caja.png" alt="">
                        </div>
                    </div>
                <?php } ?>
                <div class="padre">
                    <div class="header">
                        <div class="contenedores-menu">

                            <div class="menu-menu">
                                <?php foreach ($respFactura as $misCompras) {
                                ?>
                                    <div class="menu-principal">
                                        <div class="cont-menudos">
                                            <br>
                                            <h2 class="titulo-factura">#<?php echo $misCompras['numeroFactura']; ?></h2>
                                            <h2 class="titulo-costo">$<?php echo number_format(round($misCompras['Costo']), 0, '', '.'); ?></h2>
                                            <h2 class="titulo-fecha"><?php echo $misCompras['fechaFactura']; ?></h2>
                                            <p class="textos">Productos:<?php echo $misCompras['Contador']; ?></p>
                                        </div>
                                        <div class="cont-menutres">
                                            <form action="misCompras.php" method="post">
                                                <input type="hidden" name="numero" value="<?php echo $misCompras['numeroFactura'] ?>">
                                                <input type="submit" class="boton-menu" value="Ver">
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mostrar el contenido de la factura seleccionada -->
            <?php }
            if (isset($_POST['numero'])) {
                $numero = $_POST['numero'];
                $factura = new Factura($documento, $numero);
                $respCuerpoFactura = $factura->CuerpoFactura($factura->id, $factura->numero)
            ?>
                <div class="container-fluid mt--6">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header border-0">
                                    <h3 class="mb-0"> </h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Costo</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php
                                            foreach ($respCuerpoFactura as $datosCompra) { ?>
                                                <tr>
                                                    <th><?php echo substr($datosCompra['nombrePublicacion'], 0, 90); ?>..</th>
                                                    <th><?php echo $datosCompra['cantidadFacturaPublicacion']; ?></th>
                                                    <th><?php echo number_format($datosCompra['costoPublicacion'], 0, '', '.'); ?></th>
                                                    <!-- <th>
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form action="verFactura.php" method="POST" target="_blank">
                                                            <input type="hidden" name="numero" value="<?php echo $datosCompra['numeroFactura']; ?>">
                                                            <button type="submit" class="btn btn-info">Ver</button>
                                                        </form>
                                                        <br>
                                                        <form action="#" method="POST" target="_blank">
                                                            <input type="hidden" name="numero" value="<?php echo $datosCompra['numeroFactura']; ?>">
                                                            <button type="submit" class="btn btn-success">Descargar</button>
                                                        </form>
                                                    </div>
                                                </th> -->
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
                </div>
            <?php } ?>
            <!-- Footer -->
<?php require_once '../includes/footer.php';
        } else {
            echo "<script>alert('No puedes acceder a esta página!');</script>";
            echo "<script> document.location.href='403.php';</script>";
        }
    }
}
?>