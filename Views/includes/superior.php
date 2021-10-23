<?php session_start(); ?>

<head>
  <link rel="stylesheet" href="../assets/css/nav.css" />
</head>

<body>
  <header>
    <div class="contenedor-navegacion">
      <div class="logo">
        <a href="./index.php">
          <img src="../assets/img/LogoTerciario.svg" alt="Logo Interoriente">
        </a>
      </div>

      <div class="busquedas">
        <input id="busquedas" type="text" placeholder="¿Qué estás buscando?">
        <img id="buscar" src="../assets/img/iconos/search.svg" alt="Buscar">
      </div>

      <div class="carrito" id="carrito-btn">
        <img id="btn-carrito" src="../assets/img/iconos/carrito.svg" alt="Carrito">
        <p class="items-carrito">0</p>
      </div>
    </div>
  </header>
  <div id="res-busquedas" class="res-busquedas">
    <div></div>
    <ul id="resultado">
    </ul>
    <div></div>

  </div>
  <div id="boton" class="boton">
    <span onclick="openNav()"> <a href="javascript:void(0)" id="menuLateral">Menú</a></span>
  </div>
  <!-- Sidebar -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" id="btn-close" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="navegacion-a">
      <img src="../assets/img/iconos/Tienda_Icon.svg" alt="">
      <a href="index.php">Inicio</a>
    </div>
    <div class="navegacion-a">
      <img src="../assets/img/iconos/catalogo.svg" alt="">
      <a href="catalogos.php">Categorías</a>
    </div>
    <?php if (isset($_SESSION['roles']) == '1') : ?>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/carrito_2.svg" alt="">
        <a href="#">Mi carrito</a>
      </div>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/money-bill-wave.svg" alt="">
        <a href="../dashboard/principal/crearPublicacion.php">Vender</a>
      </div>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/compras.svg" alt="">
        <a href="../dashboard/principal/misCompras.php">Mis compras</a>
      </div>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/Estadisticas_Icon.svg" alt="">
        <?php if ($_SESSION['roles'] == '1') { ?>
          <a href="../dashboard/principal/dashboard.php">Volver al panel</a>
        <?php  } else { ?>
          <a href="../dashboard/principal/dashboardAdmin.php">Volver al panel</a>
        <?php } ?>
      </div>
    <?php endif;
    if (!isset($_SESSION['roles'])) {
    ?>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/User_Icon.svg" alt="">
        <a href="iniciarsesion.php">Iniciar sesión</a>
      </div>
    <?php } else { ?>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/sign-out.svg" alt="">
        <form class="cerrar-sesion" action="../../Controllers/php/users/usuarios.php" method="POST">
          <input type="hidden" name="cerrarSesion">
          <input class="btnCerrar" type="submit" value="Cerrar Sesión">
        </form>
      </div>
    <?php } ?>
    <div class="navegacion-a">
      <img src="../assets/img/iconos/Ayuda_Icon.svg" alt="">
      <a href="#">Ayuda</a>
    </div>
  </div>
  <div id="main" class="main-container">
    <div class="contenido">
      <!--  Contenido Principal del la página -->
    </div>
    <!-- Js para las busquedas -->
    <script src="../js/busquedas.js"></script>
    <!-- Carrito -->
    <div class="cart-overlay" id="overlay">
      <div class="cart">
        <span class="close-cart">
          <img src="../assets/img/iconos/exit.svg" alt="Cerrar Carrito">
        </span>
        <h2 class="titulos">Tu carrito</h2>
        <div class="cart-content">
          <!--Contenido del carrito controlado por JavaScript-->
        </div>
        <div class="cart-footer">
          <h4>Subtotal: $ <span class="cart-total">0</span></h4>
          <!-- Botones temporales  -->
          <button class="finalizar-compra" id="finalizar-compra">Finalizar comprar</button>
        </div>
      </div>

    </div>
    <!-- Fin Carrito -->