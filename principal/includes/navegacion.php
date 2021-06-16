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
  </div>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">Mi cuenta</a>
    <a href="#">Ofertas</a>
    <a href="#">Catálogos</a>
    <a href="#">Ayuda</a>
  </div>

  <div id="main">
    <div id="boton" class="boton">
      <a href="#" id="menuLateral"><span onclick="openNav()">Menú</span></a>
    </div>
    <div class="contenido">
      <!-- Contenido Principal del la página -->
      <?php $FILES = get_included_files();  // Retrieves files included as array($FILE)
      $FILE = __FILE__;     
      echo $FILE;          // Set value of current file with absolute path
       ?>
      <!--Final Contenido Principal del la página -->
    </div>
  </div>
  <!-- Javascript de la barra lateral -->
  <script src="../../assets/js/sidebar.js"></script>
</body>

</html>