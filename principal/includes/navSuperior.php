<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../assets/css/estilosNavs.css" />
  <title>Navbar Superior</title>
</head>

<body>
  <div class="contenedor">
    <div class="logoT">
      <a href="index.php"> <img src="../../assets/img/LogoTerciario.svg" alt="Logo interoriente" /></a>
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
      <a href="../navSuperior/carrito.php">
        <div class="carrito"><img src="../../assets/img/iconos/carrito.svg" alt="Carrito de la compra"></div>
      </a>
    </div>
  </div>
  <!-- Sidebar -->

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <!--   <div class="perfil">
            <img src="../../assets/img/perfil.svg" alt="">

    </div> -->

    <?php if (isset($_SESSION['roles']) == "3" or isset($_SESSION['roles']) == "2"  or isset($_SESSION['roles']) == "1") { ?>

      <?php if ($_SESSION['roles'] == "3") { ?>
        <!-- ROl admin -->
        <a href="#">Mis ofertas</a>
        <a href="#">Mis catálogos</a>
        <a href="#">Ayuda</a>
        <a href="../../users/dashboard/principal/dashboard.php">Volver al panel</a>
        <a href="../../controller/cerrar_sesion.php">Cerrar sesión</a>
      <?php } else if ($_SESSION['roles'] == "2") { ?>
        <!-- ROl admininistrador Empresa-->
        <a href="#">Mis ofertas</a>
        <a href="#">Mis catálogos</a>
        <a href="#">Ayuda</a>
        <a href="../../users/dashboard/principal/dashboard.php">Volver al panel</a>
        <a href="../../controller/cerrar_sesion.php">Cerrar sesión</a>

      <?php } else { ?>
        <!-- ROl comprador/Proveedor -->

        <a href="#">Ofertas</a>
        <a href="#">Catálogos</a>
        <a href="#">Mi carrito</a>
        <a href="#">Mis compras</a>
        <a href="#">Ayuda</a>
        <a href="../../users/dashboard/principal/dashboard.php">Volver al panel</a>
        <a href="../../controller/cerrar_sesion.php">Cerrar sesión</a>

      <?php } ?>

    <?php } else { ?>
      <!-- Poner imagen-->
      <a href="">
        <img id="cta-login-img" src="../../assets/img/navegacion/login_2.svg" alt="Ingreso Interoriente">
        <p id="cta-p">¡Regístrate o Inicia sesión para comenzar!</p>
     
        
      </a>
  
      <a href="#">Ofertas</a>
      <a href="../navegacion/productos.php">Catálogos</a>
      <a href="#">Ayuda</a>
      <a href="iniciarsesion.php">Iniciar sesión</a>
    <?php } ?>

  </div>
  <div id="main" class="main-container">
    <div id="boton" class="boton">
      <a href="#" id="menuLateral"><span onclick="openNav()">Menú</span></a>
    </div>
    <div class="contenido">
      <!--  Contenido Principal del la página -->
    </div>