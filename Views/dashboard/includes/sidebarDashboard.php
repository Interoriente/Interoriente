<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header ">
      <a class="logoHome" href="../../navegacion/index.php">
        <img id="homeLogo" src="../../assets/img/logoDashboard.svg" class="navbar-brand-img" alt="home logo Interoriente">
      </a>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <?php if (isset($_SESSION['roles']) == "3" or isset($_SESSION['roles']) == "1") {
          if ($_SESSION['roles'] == "1") { ?>
            <ul class="navbar-nav">
              <li class="nav-item" id="item">
                <a class="nav-link" href="dashboard.php">
                  <i class="ni ni-tv-2 text-primary"></i>
                  <span class="nav-link-text">Dashboard</span>
                </a>
              </li>
              <li class="nav-item" id="item">
                <a class="nav-link" href="perfil.php">
                  <i class="ni ni-single-02" style="color: #5D9BAC"></i>
                  <span class="nav-link-text">Mi perfil</span>
                </a>
              </li>
              <li class="nav-item" id="item">
                <a class="nav-link" href="crearPublicacion.php">
                  <i class="ni ni-album-2" style="color: #FFB720"></i>
                  <span class="nav-link-text">Crear publicación</span>
                </a>
              </li>
              <li class="nav-item" id="item">
                <a class="nav-link" href="misPublicaciones.php">
                  <i class="ni ni-book-bookmark" style="color: #FFB930"></i>
                  <span class="nav-link-text">Mis publicaciones</span>
                </a>
              </li>
              <li class="nav-item" id="item">
                <a class="nav-link" href="misCompras.php">
                  <i class="ni ni-briefcase-24"></i>
                  <span class="nav-link-text">Mis compras</span>
                </a>
              </li>
            </ul>
          <?php }
          if ($_SESSION['roles'] == "3") { ?>
            <ul class="navbar-nav">
              <li class="nav-item" id="item">
                <a class="nav-link" href="dashboardAdmin.php">
                  <i class="ni ni-tv-2 text-primary"></i>
                  <span class="nav-link-text">Dashboard</span>
                </a>
              </li>
              <li class="nav-item" id="item">
                <a class="nav-link" href="perfilAdmin.php">
                  <i class="ni ni-single-02" style="color: #5D9BAC"></i>
                  <span class="nav-link-text">Mi perfil</span>
                </a>
              </li>
              <li class="nav-item" id="item">
                <a class="nav-link" href="publicaciones.php">
                  <i class="ni ni-single-copy-04 text-purple"></i>
                  <span class="nav-link-text">Validar publicaciones</span>
                </a>
              </li>
              <?php if ($_SESSION['documentoIdentidad'] == '123456789') {
              ?>
                <li class="nav-item" id="item">
                  <a class="nav-link" href="registrarAdmin.php">
                    <i class="ni ni-building text-orange"></i>
                    <span class="nav-link-text">Registrar Admin</span>
                  </a>
                </li>
                <?php } ?>
                <li class="nav-item" id="item">
                  <a class="nav-link" href="listaAdmin.php">
                    <i class="ni ni-atom text-blue"></i>
                    <span class="nav-link-text">Administradores</span>
                  </a>
                </li>
            </ul>
        <?php }
        } ?>
      </div>
    </div>
  </div>
</nav>