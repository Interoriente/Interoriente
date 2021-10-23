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
      <!-- Mirar la posibilidad de enviar un mensaje al correo de usuario
 al que se le va a crear la cuenta, confirmardole la creación y 
 pasando la contraseña -->
      <!-- Header -->
      <div class="header pb-6 d-flex align-items-center">
        <span class="mask" style="background-color: #004E64;"></span>
        <!-- Mask -->
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
          <div class="row">
            <div class="col-lg-12 col-md-10">
              <h1 class="display-2 text-white">Registrar administrador</h1>
              <p class="text-white mt-0 mb-5">En este formulario se pueden registrar nuevos administradores.</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--7">
        <div class="row">
          <div class="col-xl-12 order-xl-1">
            <div class="card">
              <div class="card-body">
                <form action="../../../Controllers/php/users/acceso.php" method="POST" enctype="multipart/form-data">
                  <h6 class="heading-small text-muted mb-4">Información del usuario</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="docu">Número Documento</label>
                          <input type="text" id="docu" name="documento" class="form-control" placeholder="Ej: 123123123" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="nombre">Nombres</label>
                          <input type="text" id="nombre" name="nombres" class="form-control" placeholder="Ej: Juan, Pedro" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="apellido">Apellidos</label>
                          <input type="text" id="apellido" name="apellidos" class="form-control" placeholder="Ej: Giraldo, Vargas" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="correo">Correo</label>
                          <input type="email" id="correo" name="correo" class="form-control" placeholder="Ej: example@gmail.com" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="registrarAdmin" required>
                        <input type="hidden" name="imagen" value="imagenes/NO_borrar.png">
                        <input type="hidden" name="contrasena" value="12345">
                      </div>
                    </div>
                    <button class="btn btn-primary btn-xs" type="submit" name="registrar">Registrar</button>
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