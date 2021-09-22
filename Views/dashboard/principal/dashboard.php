<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
  require "../../../Controllers/php/users/usuarios.php";
  $documento = $_SESSION["documentoIdentidad"];
  $usuario = new Usuario($documento);
  $respUserData = $usuario->getUserData($usuario->id);
  $respGetRoles = $usuario->getRoles($usuario->id);

  //Se va a tener temporal (Para pruebas)
  require "../../../Models/dao/conexion.php";
  $sqlDatos = "SELECT month(FA.fechaFactura) AS 'Mes', 
  SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS 'Total'
  FROM tblFactura AS FA
  INNER JOIN tblFacturaPublicacion AS FP
  ON FP.numFacturaPublicacion = FA.numeroFactura
  INNER JOIN tblPublicacion AS PU 
  ON PU.idPublicacion = FP.idPublicacionFactura
  WHERE YEAR(FA.fechaFactura) = YEAR(CURDATE())
  GROUP BY month(FA.fechaFactura)";
  $stmtDatos = $pdo->prepare($sqlDatos);
  $stmtDatos->execute();
  $labelVentas = "";
  $datosVentas = "";
  $resultadoDatos = $stmtDatos->fetchAll();
  foreach ($resultadoDatos as $datos) {
    $labelVentas = $labelVentas . $datos['Mes'] . ",";
    $datosVentas = $datosVentas . $datos['Total'] . ",";
  }
  $labelVentas=rtrim($labelVentas,",");
  $datosVentas=rtrim($datosVentas,",");
}

if (isset($respUserData)) {
  $rol = $_SESSION['roles'];
  //Validacion de roles
  if ($rol == 1 or $rol == 3) {

    //Parte superior del HTML
    require "../assets/header.php";

    if (isset($_POST['cambioRol'])) {
      if ($_POST['rol'] == '1') {
        $_SESSION['roles'] = 1;
      } else {
        $_SESSION['roles'] = 3;
      }
    }
    require_once '../assets/sidebarDashboard.php';
    require_once '../assets/navegacion.php';
?>
    <script>
      var labelVentas = [<?php echo $labelVentas; ?>]
      var datosVentas = [<?php echo $datosVentas; ?>]
    </script>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Fila de botones siperiores -->
          <?php
          foreach ($respGetRoles as $datosRol) : ?>
            <form action="dashboard.php" method="post">
              <input type="hidden" name="rol" value="<?php echo $datosRol['idUsuarioRol'] ?>">
              <br><button type="submit" class="btn btn-sm btn-neutral" name="cambioRol"><?php echo $datosRol['nombreRol']; ?></button>
            </form>
          <?php endforeach; ?>
          <br>
          <div class="row align-items-center py-4">

            <div class="col-lg-6 col-5 text-center">

              <!-- FIN Lista desplegable de cambio de roles -->

              <!-- Copia de seguridad DB -->
              <?php if ($_SESSION['roles'] == '3') : ?><br>
                <a href="../../../Models/operaciones/backupDB.php"><button type="submit" class="btn btn-sm btn-neutral">Copia de seguridad BD</button></a>
              <?php endif; ?>
              <!-- FIN Copia de seguridad DB -->

            </div>
          </div>

          <!-- Tarjetas -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <!-- Contenedor Tarjetas -->
              <div class="card card-stats">
                <!-- Tarjeta -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total traffic</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $_SESSION['roles'] ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>

              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Tarjeta -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                      <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Tarjeta -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                      <span class="h2 font-weight-bold mb-0">924</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Tarjeta -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                      <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 30]}]}}' data-prefix="$" data-suffix="M">

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
                  <h5 class="h3 mb-0">No. de ventas del 4 al 5 de septiembre</h5>
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
            <div class="col text-right">
              <a href="#!" class="btn btn-sm btn-primary">Ver más</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Page name</th>
                <th scope="col">Visitors</th>
                <th scope="col">Unique users</th>
                <th scope="col">Bounce rate</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">
                  /argon/
                </th>
                <td>
                  4,569
                </td>
                <td>
                  340
                </td>
                <td>
                  <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                </td>
              </tr>
              <tr>
                <th scope="row">
                  /argon/index.html
                </th>
                <td>
                  3,985
                </td>
                <td>
                  319
                </td>
                <td>
                  <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                </td>
              </tr>
              <tr>
                <th scope="row">
                  /argon/charts.html
                </th>
                <td>
                  3,513
                </td>
                <td>
                  294
                </td>
                <td>
                  <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                </td>
              </tr>
              <tr>
                <th scope="row">
                  /argon/tables.html
                </th>
                <td>
                  2,050
                </td>
                <td>
                  147
                </td>
                <td>
                  <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                </td>
              </tr>
              <tr>
                <th scope="row">
                  /argon/profile.html
                </th>
                <td>
                  1,795
                </td>
                <td>
                  190
                </td>
                <td>
                  <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Para el admin -->
      <div class="card ">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Ventas por municipio</h3>
            </div>
            <div class="col text-right">
              <a href="#!" class="btn btn-sm btn-primary">Ver todo</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Municipio</th>
                <th scope="col">No. Ventas</th>
                <th scope="col">Porcentaje sobre ventas totales</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">
                  Facebook
                </th>
                <td>
                  1,480
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2"><?php $x = 56;
                                        echo $x ?>%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $x ?>%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Facebook
                </th>
                <td>
                  5,480
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2">70%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Google
                </th>
                <td>
                  4,807
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2">80%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Instagram
                </th>
                <td>
                  3,678
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2">75%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  twitter
                </th>
                <td>
                  2,645
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2">30%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- Para el admin -->
        </div>
      </div>
      <!-- Fin Clase columna -->

      <!-- Parte Inferior del HTML -->
  <?php require_once '../assets/footer.php';
  } else {
    echo "<script>alert('No puedes acceder a esta página!');</script>";
    echo "<script> document.location.href='403.php';</script>";
  }
} else {
  echo "<script>alert('No has iniciado sesión!');</script>";
  echo "<script> document.location.href='403.php';</script>";
}

  ?>