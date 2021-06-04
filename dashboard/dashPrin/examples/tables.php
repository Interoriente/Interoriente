<?php
session_start();

if (isset($_SESSION["correo"]) or isset($_SESSION["idusuario"])) {
  $id = $_SESSION["correo"];
  include_once '../../../dao/conexion.php';
  $sql_validacion = "SELECT*FROM tblusuarios WHERE correo ='$id' AND estado= '1'";
  $consulta_resta_validacion = $pdo->prepare($sql_validacion);
  $consulta_resta_validacion->execute();
  $resultado_validacion = $consulta_resta_validacion->rowCount();
  $validacion = $consulta_resta_validacion->fetch(PDO::FETCH_OBJ);
  //Validacion de roles
  if ($resultado_validacion) {
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
  <?php require_once '../assets/sidebar.php' ?>
  <?php require_once '../assets/header.php' ?>
  <!-- Header -->
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tables</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
            <a href="#" class="btn btn-sm btn-neutral">New</a>
            <a href="#" class="btn btn-sm btn-neutral">Filters</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">Light table</h3>
          </div>
          <!-- Light table -->
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">Project</th>
                  <th scope="col" class="sort" data-sort="budget">Budget</th>
                  <th scope="col" class="sort" data-sort="status">Status</th>
                  <th scope="col">Users</th>
                  <th scope="col" class="sort" data-sort="completion">Completion</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody class="list">
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Argon Design System</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $2500 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-warning"></i>
                      <span class="status">pending</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">60%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/angular.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Angular Now UI Kit PRO</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $1800 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-success"></i>
                      <span class="status">completed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/sketch.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Black Dashboard</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $3150 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-danger"></i>
                      <span class="status">delayed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">72%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/react.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">React Material Dashboard</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $4400 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-info"></i>
                      <span class="status">on schedule</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">90%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/vue.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Vue Paper UI Kit PRO</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $2200 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-success"></i>
                      <span class="status">completed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Card footer -->
          <div class="card-footer py-4">
            <nav aria-label="...">
              <ul class="pagination justify-content-end mb-0">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">
                    <i class="fas fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">
                    <i class="fas fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- Dark table -->
    <div class="row">
      <div class="col">
        <div class="card bg-default shadow">
          <div class="card-header bg-transparent border-0">
            <h3 class="text-white mb-0">Dark table</h3>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-dark table-flush">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="sort" data-sort="name">Project</th>
                  <th scope="col" class="sort" data-sort="budget">Budget</th>
                  <th scope="col" class="sort" data-sort="status">Status</th>
                  <th scope="col">Users</th>
                  <th scope="col" class="sort" data-sort="completion">Completion</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody class="list">
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Argon Design System</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $2500 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-warning"></i>
                      <span class="status">pending</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">60%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/angular.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Angular Now UI Kit PRO</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $1800 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-success"></i>
                      <span class="status">completed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/sketch.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Black Dashboard</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $3150 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-danger"></i>
                      <span class="status">delayed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">72%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/react.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">React Material Dashboard</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $4400 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-info"></i>
                      <span class="status">on schedule</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">90%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                        <img alt="Image placeholder" src="../assets/img/theme/vue.jpg">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">Vue Paper UI Kit PRO</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    $2200 USD
                  </td>
                  <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-success"></i>
                      <span class="status">completed</span>
                    </span>
                  </td>
                  <td>
                    <div class="avatar-group">
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                        <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                        <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                      </a>
                      <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="completion mr-2">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php require_once '../assets/footer.php' ?>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>
<?php
  } else {
    echo "<script> document.location.href='404.php';</script>";
  }
}
?>