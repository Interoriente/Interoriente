<!-- Main content -->
<div class="main-content" id="panel">
  <!-- Topnav -->
  <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center ml-md-auto">
          <!-- Botones para cerrar el sidebar -> Revisar para vistas pequeñas porque se esconde -->
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav align-items-center ml-auto ml-md-0">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <!--- Impresión imagen de perfil -->
                  <img alt="Image placeholder" src="<?php echo $respUserData->imagenUsuario; ?>">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">

                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $respUserData->nombresUsuario . " " . $respUserData->apellidoUsuario; ?></span>

                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">!Bienvenid@!</h6>
              </div>
              <?php if ($_SESSION['roles'] == 1) { ?>
                <a href="../principal/perfil.php" class="dropdown-item">
                <?php  } else { ?>
                  <a href="../principal/perfilAdmin.php" class="dropdown-item">
                  <?php } ?>
                  <i class="ni ni-single-02"></i>
                  <span>Mi perfil</span>
                  </a>
                  <a href="../../../Docs/ManualDeUsuario_Interoriente.pdf" class="dropdown-item" target="_blank">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>Manuales</span> <!-- Colocar aquí manual de usuario y formato IEE (Manual del sistema) -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                    <i class="ni ni-user-run"></i>
                    <span>Cerrar Sesión</span>
                  </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Seguro quieres salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Seleccione "Cerrar sesión" a continuación si estas listo para finalizar la sesión actual.
        </div>
        <form class="cerrar-sesion" action="../../../Controllers/php/users/usuarios.php" method="POST">
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>

            <input type="hidden" name="cerrarSesion">
            <button class="btn btn-primary" type="submit">Cerrar Sesión</button>

          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="fotoperfil" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <img class=" card-img-top" src="<?php echo $respUserData->imagenUsuario; ?>">
        </div>
      </div>
    </div>
  </div>
  <!--/Modal -->