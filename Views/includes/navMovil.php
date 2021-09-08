<div class="contenedor-nav">
    <div class="navbar">
        <?php if (isset($_SESSION['roles']) == "3"  or isset($_SESSION['roles']) == "1") { ?>
            <?php if ($_SESSION['roles'] == "3") { ?>
                <!-- ROl admin -->
                <a href="#">Mis ofertas</a>
                <a href="catalogoProd.php">Catálogos</a>
                <a href="#">Ayuda</a><!-- Este botón se puede utilizar para que redireccione al manual del aplicativo -->
                <a href="../dashboard/principal/dashboard.php">Volver al panel</a>
                <form class="cerrar-sesion" action="../../Controllers/php/users/usuarios.php" method="POST">
                    <input type="hidden" name="cerrarSesion">
                    <button class="btn btn-primary" type="submit">Cerrar Sesión</button>
                </form>
            <?php } else { ?>
                <!-- ROl comprador/Proveedor -->

                <a href="#">Ofertas</a>
                <a href="catalogoProd.php">Catálogos</a>
                <a href="#">Mi carrito</a>
                <a href="#">Mis compras</a>
                <a href="#">Ayuda</a>
                <a href="../dashboard/principal/dashboard.php">Volver al panel</a>
                <form class="cerrar-sesion" action="../../Controllers/php/users/usuarios.php" method="POST">
                    <input type="hidden" name="cerrarSesion">
                    <button class="btn btn-primary" type="submit">Cerrar Sesión</button>
                </form>

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