<div class="contenedor-nav">
    <div class="navbar">
        <a href="index.php">Inicio</a>
        <a href="#">Ayuda</a>
        <a href="oferta.php">Ofertas</a>
        <a href="catalogos.php">Categorías</a>
        <?php if (isset($_SESSION['roles']) == '1') : ?>
            <a href="#">Mi carrito</a>
            <a href="#">Mis compras</a>
            <a href="../dashboard/principal/dashboard.php">Volver al panel</a>
        <?php endif;
        if (!isset($_SESSION['roles'])) {
        ?>
            <a href="iniciarsesion.php">Iniciar sesión</a>
        <?php } else { ?>
            <img src="../assets/img/iconos/sign-out.svg" alt="">
            <input type="hidden" name="cerrarSesion">
            <input class="btnCerrar" type="submit" value="Cerrar Sesión">
            </form>
        <?php } ?>
    </div>
</div>