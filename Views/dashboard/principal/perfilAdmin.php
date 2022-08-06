<?php
session_start();
if (!isset($_SESSION['documentoIdentidad'])) {
  echo "<script>alert('No has iniciado sesión!');</script>";
  echo "<script> document.location.href='403.php';</script>";
} else {
  $documento = $_SESSION["documentoIdentidad"];
  require "../../../Controllers/php/users/usuarios.php";
  require "../../../Controllers/php/users/publicaciones.php";
  $usuario = new Usuario($documento);
  $respUserData = $usuario->getUserData($usuario->id);
  $respGetCiudades = $usuario->getCiudades();
  /* Contador de mis compras */
  require "../../../Controllers/php/users/compras.php";
  $compra = new Compra($documento);

  $respFactura = $compra->FacturasCreadas($compra->id);
  $contadorFactura = count($respFactura);
  /* Mostrar nombre completo del usuario logeado */
  $nombreUsuario = $respUserData->nombresUsuario . " " . $respUserData->apellidoUsuario;
  if (isset($respUserData)) {
    $rol = $_SESSION['roles'];
    //Validacion de roles
    if ($rol  == 3) {
      //Parte superior del HTML
      require "../includes/header.php";

      require_once '../includes/sidebarDashboard.php';
      require_once '../includes/navegacion.php';
?>
      <!-- Mostrar error cuando no exista direcciones asociadas -->
      <link rel="stylesheet" href="../../assets/css/general.css">
      <link rel="stylesheet" href="../assets/css/misPublicaciones.css">
      <!-- Header -->
      <div class="header pb-6 d-flex align-items-center">
        <span class="mask" style="background-color: #004E64;"></span>
        <!-- Mask -->
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
          <div class="row">
            <div class="col-lg-12 col-md-10">
              <h1 class="display-2 text-white">¡Hola, Administrador!</h1>
              <p class="text-white mt-0 mb-5">Este es tu perfil. Aquí podrás visualizar tu información y actualizarla en cualquier momento.</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--7">
        <div class="row">
          <div class="col-xl-12 order-xl-1">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">Editar perfil </h3>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="../../../Controllers/php/users/usuarios.php" method="POST" enctype="multipart/form-data">
                  <h6 class="heading-small text-muted mb-4">Información de usuario</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="docu">Documento</label>
                          <input type="text" id="docu" name="documento" class="form-control" placeholder="Documento" value="<?php echo $respUserData->documentoIdentidad; ?>" disabled required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">Nombre</label>
                          <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $respUserData->nombresUsuario; ?>" required disabled>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">Apellido</label>
                          <input type="text" id="input-username" name="apellido" class="form-control" placeholder="Apellido" value="<?php echo $respUserData->apellidoUsuario; ?>" required disabled>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">Celular</label>
                          <input type="number" id="input-username" name="celular" class="form-control" placeholder="Celular" max="9999999999" value="<?php echo $respUserData->telefonomovilUsuario; ?>" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-email">Correo</label>
                          <input type="email" id="input-email" name="correo" class="form-control" value="<?php echo $respUserData->emailUsuario; ?>" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-image">Foto de Perfil</label>
                          <input type="file" id="input-image" name="file" class="form-control-file">
                        </div>
                        Si no quieres cambiar la foto de perfil, puedes dejar este campo en blanco
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="documentoUsuario" value="<?php echo $documento; ?>" required>
                        <input type="hidden" name="actualizarCuenta" value="<?php echo $documento; ?>" required>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-xs" type="submit" name="subir">Editar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
<?php require_once '../includes/footer.php';
    } else {
      echo "<script>alert('No puedes acceder a esta página!');</script>";
      echo "<script> document.location.href='403.php';</script>";
    }
  }
}
?>