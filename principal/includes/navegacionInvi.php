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
      <img src="../../assets/img/LogoTerciario.svg" alt="" />
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
      <a href="../navegacion/carrito.php">
        <div class="carrito"><img src="../../assets/img/iconos/carrito.svg" alt="Carrito de la compra"></div>
      </a>
    </div>
  </div>
  <!-- Sidebar -->

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="perfil">
      <!--       <img src="../../assets/img/perfil.svg" alt="">
 -->
    </div>
    <a href="#">Ofertas</a>
    <a href="#">Catálogos</a>
    <a href="#">Ayuda</a>
    <a href="iniciarsesion.php">Iniciar sesión</a>
  </div>
  <div id="main" class="main-container">
    <div id="boton" class="boton">
      <a href="#" id="menuLateral"><span onclick="openNav()">Menú</span></a>
    </div>
    <div class="contenido">
      <!--  Contenido Principal del la página -->