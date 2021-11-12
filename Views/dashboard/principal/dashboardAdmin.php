<?php
session_start();
if (!isset($_SESSION['documentoIdentidad'])) {
  echo "<script>alert('No has iniciado sesión!');</script>";
  echo "<script> document.location.href='403.php';</script>";
} else {
  require "../../../Controllers/php/users/usuarios.php";
  $documento = $_SESSION["documentoIdentidad"];
  $usuario = new Usuario($documento);
  $respUserData = $usuario->getUserData($usuario->id);
  $respGetRoles = $usuario->getRoles($usuario->id);
  require "../../../Controllers/php/users/informes.php";
  //Instancio la clase
  $informe = new Informes($documento, 1);
  //Llamo la función para mostrar las publicaciones sin validar
  $noValidadas = $informe->NoValidadasAdmin();
  $contadorNovalidadas = sizeof($noValidadas);
  $respVentasHoy = $informe->VentasHoyAdmin();
  $respTotalMensual = $informe->ReporteMensualAdmin();
  $respVentasAnual = $informe->VentasAnualesAdmin();
  $respVentasDia = $informe->VentasPorDiasAdmin();
  $respContadorUsuario = $informe->ContadorUsuarios();
  $respUsuariosQueMasCompran = $informe->UsuariosQueMasCompran();
  //Mostrar gráfica de ventas anuales
  require "../includes/graficas.php";

  if (isset($respUserData)) {
    $rol = $_SESSION['roles'];
    //Validacion de roles
    if ($rol == 3) {

      //Parte superior del HTML
      require "../includes/header.php";
      require_once '../includes/sidebarDashboard.php';
      require_once '../includes/navegacion.php';
?>
      <script>
        //Mando al JS la información, por medio de las variables declaradas
        let labelVentas = [<?php echo $labelVentas; ?>];
        let datosVentas = [<?php echo $datosVentas; ?>];
        let labelVentasSemana = [<?php echo $labelVentasSemana; ?>];
        let datosVentasSemana = [<?php echo $datosVentasSemana; ?>];
      </script>
      <!-- Para mostrar en la sección de publicación más exitosa (cuando no exista) -->
      <link rel="stylesheet" href="../../assets/css/general.css">
      <link rel="stylesheet" href="../assets/css/misPublicaciones.css">

      <!-- Header -->
      <div class="header bg-primary pb-6">

        <div class="container-fluid">

          <div class="header-body">
            <!-- Fila de botones siperiores -->
            <div class="row align-items-center py-3">

              <?php
              foreach ($respGetRoles as $datosRol) : ?>
                <form action="cambioRol.php" method="post">
                  <input type="hidden" name="rol" value="<?php echo $datosRol['idUsuarioRol'] ?>">
                  <br>
                  <?php if ($_SESSION['roles'] != $datosRol['idUsuarioRol']) { ?>
                    <button type="submit" class="btn btn-sm btn-neutral cambioRol" name="cambioRol"><?php echo $datosRol['nombreRol']; ?></button>
                  <?php } ?>
                </form>
              <?php endforeach; ?>
              <div class="text-center">
                <!-- FIN Lista desplegable de cambio de roles -->
                <!-- Copia de seguridad DB -->
                <?php if ($_SESSION['roles'] == '3') : ?><br>
                  <a href="../../../Models/operaciones/backupDB.php"><button type="submit" class="btn btn-sm btn-neutral cambioRol">Copia de seguridad BD</button></a>
                <?php endif; ?>
                <!-- FIN Copia de seguridad DB -->
              </div>
            </div>
            <!-- Tarjetas -->

            <div class="row">
              <!-- Contenedor Tarjeta -->
              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Tarjeta -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Usuarios</h5>
                        <span class="h5 font-weight-bold mb-0 text-rap text-danger">Hay <?php echo $respContadorUsuario['Contador'] ?> registrados </span>
                      </div>
                      <div class="col-auto icono-dashboard">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="ni ni-notification-70"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Contenedor Tarjeta -->
              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <a data-toggle="modal" data-target="#verNovalidadas">
                    <!-- Tarjeta -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Publicaciones</h5>
                          <?php if (isset($noValidadas)) { ?>
                            <span class="h5 font-weight-bold mb-0 text-rap text-warning">Tienes <?php echo $contadorNovalidadas; ?> publicaciones para validar.</span>
                        </div>
                        <div class="col-auto icono-dashboard">
                          <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                            <i class="ni ni-album-2"></i>
                          </div>
                        </div>
                      <?php } else { ?>
                        <span class="h5 font-weight-bold mb-0 text-blue">No tienes publicaciones por validar</span>
                      </div>
                      <div class="col-auto icono-dashboard">
                        <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                          <i class="ni ni-like-2"></i>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Tarjeta -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Este Mes...</h5>
                      <span class="h2 font-weight-bold mb-0">Total ventas: $<?php echo number_format($respTotalMensual['Total'], 0, '', '.'); ?></span>
                    </div>

                    <div class="col-auto icono-dashboard">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Tarjeta -->
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Ventas Hoy</h5>
                      <span class="h2 font-weight-bold mb-0 text-success mr-2">$<?php echo number_format($respVentasHoy["Total"], 0, '', '.'); ?></span>
                    </div>
                    <div class="col-auto icono-dashboard">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">No. Ventas:</span>
                    <span class="h2 text-success mr-2"><?php echo $respVentasHoy["No_ventas"] ?></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Fin tarjeta -->
          </div>
          <!-- Fin Tarjeta -->
        </div>
        <!-- Mirar la forma de bajar el contenido sin br. -->
        <br><br><br>
        <div class="header bg-primary pb-6">
          <div class="container-fluid mt--6">
            <div class="row">
              <div class="col-xl-8">
                <div class="card bg-default">
                  <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                      <div class="col">
                        <h6 class="text-light text-uppercase ls-1 mb-1">Reporte Anual 2021</h6>
                        <h5 class="h3 text-white mb-0">Ventas generales</h5>
                      </div>
                      <div class="col">
                        <ul class="nav nav-pills justify-content-end">
                          <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 30]}]}}' data-prefix="$" data-suffix=".">

                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                      <!-- Chart wrapper -->
                      <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card">
                  <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                      <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Reporte Semanal </h6>
                        <h5 class="h3 mb-0">No. de ventas en los últimos 7 días</h5>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                      <canvas id="chart-bars" class="chart-canvas"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Usuarios que más compran</h3>
                  </div>
                  <div class="input-daterange datepicker row align-items-center">
                    <div class="col">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          </div>
                          <input class="form-control" placeholder="Start date" type="date" max=<?php $hoy = date("Y-m-d");
                                                                                                echo $hoy; ?>>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          </div>
                          <input class="form-control" placeholder="End date" type="date" max=<?php $hoy = date("Y-m-d");
                                                                                              echo $hoy; ?>>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button id="buscarPublicacion" type="submit" class="btn btn-sm btn-neutral cambioRol" name="buscarPublicaciones">Buscar</button>
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <?php if (isset($respUsuariosQueMasCompran)) { ?>
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total de compras</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Fila -->
                      <?php foreach ($respUsuariosQueMasCompran as $datos) : ?>
                        <tr>
                          <td>
                            <?php echo $datos['Cliente']; ?>
                          </td>

                          <td>
                            <?php echo $datos['Cantidad']; ?>
                          </td>

                          <td>
                            <?php echo number_format($datos['Total'], 0, '', '.'); ?>
                          </td>
                        </tr>
                      <?php endforeach;
                    } else { ?>
                      <div class="campo-alerta">
                        <div class="alerta" role="alert">Opps, por ahora no hay publicaciones exitosas
                          <img class="img-caja" src="../assets/img/lupa.png" alt="">
                        </div>
                      </div>
                      <!--Fin Fila -->
                    </tbody>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Parte Inferior del HTML -->
  <?php
      require "../includes/modalesInformacion.php";
      require_once '../includes/footer.php';
    } else {
      echo "<script>alert('No puedes acceder a esta página!');</script>";
      echo "<script> document.location.href='403.php';</script>";
    }
  }
}
  ?>