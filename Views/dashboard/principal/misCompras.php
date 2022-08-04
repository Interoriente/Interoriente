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
            <div class="header bg-primary pb-0">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-3">
                            <div class="col-lg-3 col-7">
                                <h6 class="h1 text-white d-inline-block mb-0" style="text-align: center;">Tus Facturas</h6><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Productos comprados -->
            <?php
            if ($contadorFactura == 0) { ?>
            <!-- En caso de no haber realizado compras -->
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
                                        <p class="textos">Productos: <?php echo $misCompras['Contador']; ?></p>
                                    </div>
                                    <div class="cont-menutres">
                                        <form action="verFactura.php" method="post" target="_blank">
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
            <!-- Footer -->
<?php require_once '../includes/footer.php';
        } else {
            echo "<script>alert('No puedes acceder a esta página!');</script>";
            echo "<script> document.location.href='403.php';</script>";
        }
    }
}
?>