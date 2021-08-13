<div class="contenedor-nav">
    <div class="navbar">
        <?php if (isset($_SESSION['roles']) == "3" or isset($_SESSION['roles']) == "2"  or isset($_SESSION['roles']) == "1") { ?>
            <?php if ($_SESSION['roles'] == "3") { ?>
                <!-- ROl admin -->
                <a href="#">Mis ofertas</a>
                <a href="catalogoProd.php">Catálogos</a>
                <a href="#">Ayuda</a><!-- Este botón se puede utilizar para que redireccione al manual del aplicativo -->
                <a href="../../users/dashboard/principal/dashboard.php">Volver al panel</a>
                <a href="../../controller/cerrar_sesion.php">Cerrar sesión</a>
            <?php } else if ($_SESSION['roles'] == "2") { ?>
                <!-- ROl admininistrador Empresa-->
                <a href="#">Mis ofertas</a>
                <a href="catalogoProd.php">Mis catálogos</a>
                <a href="#">Ayuda</a>
                <a href="../../users/dashboard/principal/dashboard.php">Volver al panel</a>
                <a href="../../controller/cerrar_sesion.php">Cerrar sesión</a>

            <?php } else { ?>
                <!-- ROl comprador/Proveedor -->

                <a href="#">Ofertas</a>
                <a href="catalogoProd.php">Catálogos</a>
                <a href="#">Mi carrito</a>
                <a href="#">Mis compras</a>
                <a href="#">Ayuda</a>
                <a href="../../users/dashboard/principal/dashboard.php">Volver al panel</a>
                <a href="../../controller/cerrar_sesion.php">Cerrar sesión</a>

            <?php } ?>

        <?php } else { ?>
            <!-- Poner imagen-->
            <a href="#">Ofertas</a>
            <a href="catalogoProd.php">Catálogos</a>
            <a href="#">Ayuda</a>
            <a href="iniciarsesion.php">Iniciar sesión</a>
        <?php } ?>
    </div>
</div>