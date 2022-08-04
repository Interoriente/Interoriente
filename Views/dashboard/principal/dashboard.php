<?php
session_start();
if (!isset($_SESSION['documentoIdentidad'])) {
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
  //Llamo la función para las ventas anuales
  $respVentasAnual = $informe->MostrarVentasAnuales($informe->id);
  //Llamo la función para las ventas de los 7 días anterior
  $respVentasDia = $informe->VentasPorDias($informe->id);
  /* Instanciar publicaciones más exitosas */
  $respMasExitosas = $informe->GetPublicacionesExitosas($informe->id, $informe->val, null);

  $alertaStock = $informe->AlertaStock($informe->id);
  $contadorAlertaStock = sizeof($alertaStock);
  /* $mostrarPublicacionPocoStock = $informe->MostrarPublicacionPocoStock($informe->id); */
  $ventasHoy = $informe->VentasHoy($informe->id);
  $noValidadas = $informe->NoValidadas($informe->id);
  $contadorNoValidadas = sizeof($noValidadas);
  $reporteMensual = $informe->ReporteMensual($informe->id);
  //Mostrar gráfica de ventas anuales
  require "../includes/graficas.php";
  if (isset($respUserData)) {
    $rol = $_SESSION['roles'];
    //Validacion de roles
    if ($rol == 1) {

      //Parte superior del HTML
      require "../includes/header.php";

      require_once '../includes/sidebarDashboard.php';
      require_once '../includes/navegacion.php';
?>
      <script>
        //Mando al JS la información, por medio de las variables declaradas
        let labelVentas = [<?= $labelVentas; ?>];
        let datosVentas = [<?= $datosVentas; ?>];
        let labelVentasSemana = [<?= $labelVentasSemana; ?>];
        let datosVentasSemana = [<?= $datosVentasSemana; ?>];
      </script>
      <!-- Para mostrar en la sección de publicación más exitosa (cuando no exista) -->
      <link rel="stylesheet" href="../../assets/css/general.css">
      <link rel="stylesheet" href="../assets/css/misPublicaciones.css">

      <!-- Header -->
      <div class="header bg-primary pb-6">

        <div class="container-fluid">

          <div class="header-body">
            <!-- Fila de botones superiores -->
            <div class=" row align-items-center py-3">

              <?php
              foreach ($respGetRoles as $datosRol) : ?>
                <form action="cambioRol.php" method="post">
                  <input type="hidden" name="rol" value="<?= $datosRol['idUsuarioRol'] ?>">
                  <br>
                  <?php if ($_SESSION['roles'] != $datosRol['idUsuarioRol']) { ?>
                    <button type="submit" class="btn btn-sm btn-neutral cambioRol" name="cambioRol"><?= $datosRol['nombreRol']; ?></button>
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
                  <?php if ($contadorAlertaStock > 0) { ?>
                    <a href="#" data-toggle="modal" data-target="#verAlertaStock">
                    <?php } else { ?>
                      <a>
                      <?php } ?>
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Stock</h5>
                            <?php if (isset($alertaStock) && $contadorAlertaStock != 0) { ?>
                              <span class="h5 font-weight-bold mb-0 text-rap text-danger">¡Hay <?= $contadorAlertaStock ?> publicaciones con poco stock! </span>
                          </div>
                          <div class="col-auto icono-dashboard">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                              <i class="ni ni-notification-70"></i>
                            </div>
                          </div>
                        <?php } else { ?>
                          <span class="h5 font-weight-bold mb-0 text-success">¡No hay alertas por stock!</span>
                        </div>
                        <div class="col-auto icono-dashboard">
                          <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                            <i class="ni ni-check-bold"></i>
                          </div>
                        </div>
                      <?php } ?>
                      </div>
                      </a>
                </div>
              </div>
            </div>

            <!-- Tarjeta para el admin -->
            <!-- Contenedor Tarjeta -->
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <?php if ($contadorNoValidadas > 0) { ?>
                  <a href="#" data-toggle="modal" data-target="#verNovalidadas">
                  <?php } else { ?>
                    <a>
                    <?php } ?>
                    <!-- Tarjeta -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Publicaciones</h5>
                          <?php if (isset($noValidadas) && $contadorNoValidadas != 0) { ?>
                            <span class="h5 font-weight-bold mb-0 text-rap text-warning">Tienes <?= $contadorNoValidadas; ?> publicaciones con espera de validación</span>
                        </div>
                        <div class="col-auto icono-dashboard">
                          <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                            <i class="ni ni-album-2"></i>
                          </div>
                        </div>
                      <?php } else { ?>
                        <span class="h5 font-weight-bold mb-0 text-blue">No tienes publicaciones pendientes por validar</span>
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

          <!-- Tarjeta -->
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Ventas Hoy</h5>
                    <span class="h2 font-weight-bold mb-0 text-success mr-2">$<?= number_format($ventasHoy["Total"], 0, '', '.'); ?></span>
                  </div>
                  <div class="col-auto icono-dashboard">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="ni ni-money-coins"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-nowrap">No. Ventas:</span>
                  <span class="h2 text-success mr-2"><?= $ventasHoy["No_ventas"] ?></i></span>
                </p>
              </div>
            </div>
          </div>
          <!-- Fin tarjeta -->
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Tarjeta -->
              <div class="card-body">
                <div class="row">
                  <?php if (isset($reporteMensual->TotalMesActual)) { ?>
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Este Mes...</h5>
                      <span class="h2 font-weight-bold mb-0">Total ventas: $<?= number_format($reporteMensual->TotalMesActual, 0, '', '.'); ?></span>
                    </div>
                  <?php } else { ?>
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Este Mes...</h5>
                      <span class="h2 font-weight-bold mb-0">Total ventas: $0</span>
                    </div>
                  <?php } ?>

                  <div class="col-auto icono-dashboard">
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      <i class="ni ni-chart-bar-32"></i>
                    </div>
                  </div>
                </div>
                <?php if (isset($reporteMensual->Subio)) {
                  if ($reporteMensual->Subio == 1) { ?>

                    <p class="mt-3 mb-0 text-sm">
                      <span id="ms-mes" class="text-success mr-2"><i class="fa fa-arrow-up"></i> <?= $reporteMensual->Porcentaje ?>%
                        <span class="text-rap">más con relación al mes anterior</span> </span>
                    </p>
                  <?php } else if ($reporteMensual->Subio == 0) { ?>
                    <p class="mt-3 mb-0 text-sm">
                      <span id="ms-mes" class="text-warning mr-2"><i class="fa fa-arrow-down"></i> <?= $reporteMensual->Porcentaje ?>%
                        <span class="text-rap">menos con relación al mes anterior</span> </span>
                    </p>
                  <?php } else { ?>
                    <p class="mt-3 mb-0 text-sm">
                      <span id="ms-mes" class="text-info mr-2">
                        <span class="text-rap">Tus ventas se han mantenido estables!</span> </span>
                    </p>
                  <?php }
                } else { ?>
                  <p class="mt-3 mb-0 text-sm">
                    <span id="ms-mes" class="text-info mr-2">
                      <span class="text-rap">Tus ventas se han mantenido estables!</span> </span>
                  </p>
                <?php } ?>
              </div>
            </div>
          </div>
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
                  <h3 class="mb-0">Publicaciones Más Exitosas</h3>
                </div>
                <!-- Formulario para capturar las fechas, y mostrar publicaciones más exitosas -->


                <div class="input-daterange datepicker row align-items-center">
                  <div class="col">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <!-- Fecha Inicial -->
                        <input id="in-fecha-inicial" class="form-control" placeholder="Start date" type="date" name="fechaIni" max=<?php $hoy = date("Y-m-d");
                                                                                                                                    echo $hoy; ?> required>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          <!-- Fecha final -->
                          <input id="in-fecha-final" class="form-control" placeholder="End date" type="date" name="fechaFin" max=<?php $hoy = date("Y-m-d");
                                                                                                                                  echo $hoy; ?> required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button id="buscarPublicacion" type="submit" class="btn btn-sm btn-neutral cambioRol" name="buscarPublicaciones">Buscar</button>
                <!-- Fin formulario -->
              </div>
            </div>
            <div class="table-responsive">
              <!-- Tabla Publicaciones más exitosas -->
              <table class="table align-items-center table-flush" id="tablaResultado">
                <?php if (isset($respMasExitosas->Titulos[0]) != "") { ?>
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Título</th>
                      <th scope="col">No. Ventas</th>
                      <th scope="col">Existencia</th>
                      <th scope="col">Total Ventas</th>
                      <th scope="col">Porcentaje</th>
                    </tr>
                  </thead>
                  <tbody id="filasExitosas">
                    <!-- Renderizar Publicaciones-->
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                      <tr>
                        <td>
                          <a href="../../navegacion/publicacion.php?id=<?= base64_encode($respMasExitosas->Ids[$i]); ?>"><?= $respMasExitosas->Titulos[$i]; ?></a>
                        </td>

                        <td>
                          <?= $respMasExitosas->NoVentas[$i]; ?>
                        </td>

                        <td>
                          <?= $respMasExitosas->Cantidad[$i]; ?>
                        </td>
                        <td>
                          <?= "$" . number_format($respMasExitosas->VlrVentas[$i], 0, '', '.'); ?>
                        </td>
                        <td>
                          <?= round($respMasExitosas->Porcentajes[$i], 1) . "%"; ?>
                        </td>
                      </tr>
                    <?php endfor;
                  } else { ?>
                    <div class="campo-alerta">
                      <div class="alerta" role="alert">Opps, por ahora no hay publicaciones exitosas
                        <img class="img-caja" src="../assets/img/lupa.png" alt="">
                      </div>
                    </div>
                    <!--Fin Renderizar Publicaciones -->
                  </tbody>


                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Parte Inferior del HTML -->
      <script src="../../js/buscarExitosas.js"></script>
<?php
      require "../includes/modalesInformacion.php";
      require_once '../includes/footer.php';
    } else {
      echo "<script> document.location.href='403.php';</script>";
    }
  }
}
?>