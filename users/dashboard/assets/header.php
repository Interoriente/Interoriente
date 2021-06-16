<!-- Main content -->
<div class="main-content" id="panel">
  <!-- Topnav -->
  <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search form -->
        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
          <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </form>
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center  ml-md-auto ">
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
          <?php
          $id = $_SESSION["emailUsuario"];
          include_once '../../../dao/conexion.php';
          $sql_inicio = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' ";
          $consulta_resta = $pdo->prepare($sql_inicio);
          $consulta_resta->execute();
          $resultado = $consulta_resta->rowCount();
          $prueba = $consulta_resta->fetch(PDO::FETCH_OBJ);
          //Validacion de roles
          if ($resultado) {
            $Nombre = $prueba->nombresUsuario . " " . $prueba->apellidoUsuario;
          ?>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                      <!--- Impresión imagen de perfil -->
                      <img alt="Image placeholder" src="<?php echo $prueba->imagenUsuario; ?>">
                    </span>
                    <div class="media-body  ml-2  d-none d-lg-block">

                      <span class="mb-0 text-sm  font-weight-bold"><?php echo $Nombre; ?></span>
                    <?php } ?>
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right ">
                  <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Bienvenidos!</h6>
                  </div>
                  <a href="../principal/perfil.php" class="dropdown-item">
                    <i class="ni ni-single-02"></i>
                    <span>Mi perfil</span>
                  </a>
                  <a href="../principal/configfotoperfil.php" class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>Cambiar foto</span>
                  </a>
                  <a href="#!" class="dropdown-item">
                    <i class="ni ni-calendar-grid-58"></i>
                    <span>Actividad</span>
                  </a>
                  <a href="#!" class="dropdown-item">
                    <i class="ni ni-support-16"></i>
                    <span>Soporte</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="../../../controller/cerrar_sesion.php" class="dropdown-item"  data-toggle="modal" data-target="#logoutModal">
                    <i class="ni ni-user-run"></i>
                    <span>Cerrar sesión</span>
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
        <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="../../../controller/cerrar_sesion.php">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>