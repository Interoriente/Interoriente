<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/navegacion.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
  <div class="contenedor">
    <div class="contenedor-s">
      <div class="logoT">
        <a id="logo" href="index.php"> <img src="../assets/img/LogoTerciario.svg" alt="Logo interoriente" /></a>
      </div>
      <div class="cont-elementos">
        <a href="Javascript:void(0)" id="comprar">
          <div class="comprar">Comprar</div>
        </a>
        <a href="">
          <div class="vender">Vender</div>
        </a>
      </div>
      <div class="barra-busqueda">
        <input type="text" placeholder="Buscar...">
      </div>
      <div class="carrito-busqueda">


        <a href="javascript:void(0)">
          <div class="carrito" id="btn-carrito"><img src="../assets/img/iconos/carrito.svg" alt="Carrito de la compra"></div>
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
    <div class="navegacion-a">
      <img src="../assets/img/iconos/Tienda_Icon.svg" alt="">
      <a href="index.php">Inicio</a>
    </div>
    <div class="navegacion-a">
      <img src="../assets/img/iconos/Ayuda_Icon.svg" alt="">
      <a href="#">Ayuda</a>
    </div>
    <div class="navegacion-a">
      <img src="../assets/img/iconos/dinero.svg" alt="">
      <a href="#">Ofertas</a>
    </div>
    <div class="navegacion-a">
      <img src="../assets/img/iconos/catalogo.svg" alt="">
      <a href="catalogo.php">Categorías</a>
    </div>
    <?php if (isset($_SESSION['roles']) == '1') : ?>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/carrito_2.svg" alt="">
        <a href="#">Mi carrito</a>
      </div>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/compras.svg" alt="">
        <a href="#">Mis compras</a>
      </div>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/Estadisticas_Icon.svg" alt="">
        <a href="../dashboard/principal/dashboard.php">Volver al panel</a>
      </div>
    <?php endif;
    if (!isset($_SESSION['roles'])) {
    ?>
      <div class="navegacion-a">
        <img src="../assets/img/iconos/compras.svg" alt="">
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
    <!-- Poner imagen-->
  </div>
  <div id="main" class="main-container">
    <div class="contenido">
      <!--  Contenido Principal del la página -->
    </div>
    <!-- Carrito -->
    <div class="cart-overlay" id="overlay">
      <div class="cart">
        <span class="close-cart">
          <i class="fas fa-window-close"></i>
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
    <script src="../js/navegacion.js"></script>
    <script src="../js/sidebar.js"></script>