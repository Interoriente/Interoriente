<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center">
      <a class="navbar-brand" href="../../../principal/navegacion/index.php">
        <img src="../../../assets/img/logo.svg" class="navbar-brand-img" alt="...">
      </a>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <?php if (isset($_SESSION['roles']) == "3" or isset($_SESSION['roles']) == "1") { ?>
          <?php if ($_SESSION['roles'] == "1") { ?>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <i class="ni ni-planet text-orange"></i>
                  <span class="nav-link-text">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="crearPubli.php">
                  <i class="ni ni-album-2 text-red"></i>
                  <span class="nav-link-text">Crear publicación</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="perfil.php">
                  <i class="ni ni-single-02 text-yellow"></i>
                  <span class="nav-link-text">Mi perfil</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="estadisticas.php">
                  <i class="ni ni-building text-brown"></i>
                  <span class="nav-link-text">Estadísticas</span>
                </a>
              </li>
            </ul><?php } else { ?>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <i class="ni ni-planet text-orange"></i>
                  <span class="nav-link-text">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="perfil.php">
                  <i class="ni ni-single-02 text-yellow"></i>
                  <span class="nav-link-text">Mi perfil</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="usuarios.php">
                  <i class="ni ni-circle-08 text-default"></i>
                  <span class="nav-link-text">Usuarios</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#!">
                  <i class="ni ni-delivery-fast text-brown"></i>
                  <span class="nav-link-text">Proveedores</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="publicaciones.php">
                  <i class="ni ni-single-copy-04 text-purple"></i>
                  <span class="nav-link-text">Publicaciones</span>
                </a>
              </li>
            </ul>
        <?php     }
              } ?>
      </div>
    </div>
  </div>
</nav>