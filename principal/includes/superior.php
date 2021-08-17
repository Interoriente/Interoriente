<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../assets/css/navegacion.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <title>Navbar Superior</title>
</head>

<body>
  <!--  <div class="carrusel-superior">
    <p>promoción</p>
  </div> -->
  <div class="contenedor">
    <div class="contenedor-s">
      <div class="logoT">
        <a id="logo" href="index.php"> <img src="../../assets/img/LogoTerciario.svg" alt="Logo interoriente" /></a>
      </div>
      <div class="cont-elementos">
        <a href="">
          <div class="comprar">Comprar</div>
        </a>
        <a href="">
          <div class="vender">Vender</div>
        </a>
      </div>
      <div class="carrito-busqueda">
        <div class="barra-busqueda">
          <input type="text" placeholder="Buscar...">
        </div>

        <a href="#">
          <div class="carrito"><img src="../../assets/img/iconos/carrito.svg" alt="Carrito de la compra"></div>
          <div class="items-carrito">0</div>
        </a>
      </div>
    </div>
    <div id="boton" class="boton">
      <span onclick="openNav()"> <a href="javascript:void(0)" id="menuLateral">Menú</a></span>
    </div>
  </div>

  <!-- Sidebar -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" id="btn-close" class="closebtn" onclick="closeNav()">&times;</a>
    <!--   <div class="perfil">
            <img src="../../assets/img/perfil.svg" alt="">

    </div> -->

    <?php if (isset($_SESSION['roles']) == "3" or isset($_SESSION['roles']) == "2"  or isset($_SESSION['roles']) == "1") { ?>

      <?php if ($_SESSION['roles'] == "3") { ?>
        <!-- ROl admin -->
        <a href="index.php">Inicio</a>
        <a href="#">Mis ofertas</a>
        <a href="../navegacion/productos.php">Catálogos</a>
        <a href="#">Ayuda</a>
        <a href="../../users/dashboard/principal/dashboard.php">Volver al panel</a>
        <a href="../../controller/cerrarSesion.php">Cerrar sesión</a>
      <?php } else if ($_SESSION['roles'] == "2") { ?>
        <!-- ROl admininistrador Empresa-->
        <a href="index.php">Inicio</a>
        <a href="#">Mis ofertas</a>
        <a href="catalogo.php">Catálogos</a>
        <a href="#">Ayuda</a>
        <a href="../../users/dashboard/principal/dashboard.php">Volver al panel</a>
        <a href="../../controller/cerrarSesion.php">Cerrar sesión</a>

      <?php } else { ?>
        <!-- ROl comprador/Proveedor -->
        <a href="index.php">Inicio</a>
        <a href="#">Ofertas</a>
        <a href="catalogo.php">Catálogos</a>
        <a href="#">Mi carrito</a>
        <a href="#">Mis compras</a>
        <a href="#">Ayuda</a>
        <a href="../../users/dashboard/principal/dashboard.php">Volver al panel</a>
        <a href="../../controller/cerrarSesion.php">Cerrar sesión</a>

      <?php } ?>

    <?php } else { ?>
      <!-- Poner imagen-->
      <a href="" id="log-info-a">
        <img id="cta-login-img" src="../../assets/img/navegacion/login_2.svg" alt="Ingreso Interoriente">
        <p id="cta-p">¡Regístrate o Inicia sesión para comenzar!</p>
      </a>
      <a href="index.php">Inicio</a>
      <a href="#">Ofertas</a>
      <a href="catalogo.php">Catálogos</a>
      <a href="#">Ayuda</a>
      <a href="iniciarsesion.php">Iniciar sesión</a>
    <?php } ?>

  </div>
  <div id="main" class="main-container">

    <div class="contenido">
      <!--  Contenido Principal del la página -->
    </div>

    <!-- Carrito -->
    <div class="cart-overlay">
      <div class="cart">
        <span class="close-cart">
          <i class="fas fa-window-close"></i>
        </span>
        <h2>Tu carrito</h2>
        <div class="cart-content">
          <!-- cart item -->
          <div class="cart-item">
            <!-- Le puse width para que no se desborde la imagen de lo grande que es. -->
            <img src="../../assets/img/stock/1.jpg" alt="product" width="100%">
            <div>
              <h4>Lorem.</h4>
              <h5>$9.000</h5>
              <span class="remove-item">Eliminar</span>
            </div>
            <div>
              <i class="fas fa-chevron-up"></i>
              <p class="item-amount">1</p>
              <i class="fas fa-chevron-down"></i>
            </div>
          </div>
          <!-- End cart item -->
        </div>
        <div class="cart-footer">
          <h3>Costo total: $ <span class="cart-total">0</span></h3>
          <button class="clear-cart eliminar-btn">Eliminar todo</button>
        </div>
      </div>

    </div>

    <script src="../../assets/js/carrito.js"></script>

    <!-- Fin Carrito -->