<?php
session_start();

if (isset($_SESSION["documentoIdentidad"])) {
  include_once 'crud/consultas.php';
  //Validacion de roles
  if ($contadorValidacion) {
    if ($resultadoSesionRol) {
      if ($sesionRol == '3') {
?>
        <!DOCTYPE html>
        <html>

        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
          <meta name="author" content="Inter-oriente">
          <title>Publicaciones - Interoriente</title>
          <!-- Favicon -->
          <link rel="icon" href="../../../assets/img/favicon.png" type="image/png">
          <!-- Fonts -->
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
          <!-- Icons -->
          <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
          <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
          <!-- Argon CSS -->
          <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
        </head>

        <body>
          <?php
          require_once '../assets/sidebarDashboard.php';
          require_once '../assets/header.php';

          include_once '../../../dao/conexion.php';
          //Llamar a la conexion base de datos -> Muestro el contenido de tabla usuario
          //Mostrar los datos almacenados
          $sqlMostrarPubli = "SELECT * FROM tblPublicacion as PU
          INNER JOIN tblImagenes 
          as IMG ON PU.idPublicacion = IMG.publicacionImagen
          GROUP BY PU.nombrePublicacion, PU.descripcionPublicacion,PU.costoPublicacion 
          ORDER BY nombrePublicacion asc"; //Prepara sentencia
          $consultarMostrarPubli = $pdo->prepare($sqlMostrarPubli);
          //Ejecutar consulta
          $consultarMostrarPubli->execute();
          $resultadoMostrarPubli = $consultarMostrarPubli->fetchAll();
          //Contador de registros totales en tabla
          $contador = $consultarMostrarPubli->rowCount();
          ?>
          <!-- Header -->
          <div class="header bg-primary pb-6">
            <div class="container-fluid">
              <div class="header-body">
                <div class="row align-items-center py-4">
                  <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Tabla de publicaciones</h6><br>
                    <h6 class="h2 text-white d-inline-block mb-0">Total: <?php echo $contador; ?></h6>
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
                    <h3 class="mb-0"> </h3>
                  </div>
                  <!-- Light table -->
                  <div class="table-responsive">
                    <table id="tabla" class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Imagen</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Costo</th>
                          <th scope="col">Stock</th>
                          <th scope="col">Estado</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        <?php
                        foreach ($resultadoMostrarPubli as $datos) { ?>
                          <tr>
                            <th><img src="../../../imagenesPubli/<?php echo $datos['urlImagen'];  ?>" alt=".." width="130px"></th>
                            <th><?php echo $datos['nombrePublicacion']; ?></th>
                            <th><?php echo substr($datos['descripcionPublicacion'], 0, 30); ?>...</th>
                            <th><?php echo $datos['costoPublicacion']; ?></th>
                            <th><?php echo $datos['stockPublicacion']; ?></th>
                            <?php if ($datos['validacionPublicacion'] == '1') { ?>
                              <th>Validada</th>
                              <div class="btn-group">
                                <th>
                                  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="btn btn-success" href="crud/desactivarPubli.php?id=<?php echo $datos['idPublicacion']; ?>">Desactivar</a>
                                    <a class="btn btn-danger" data-toggle="modal" data-target="#eliminarPubliModal<?php echo $datos['idPublicacion'] ?>">Eliminar</a>
                                  </div>
                                </th>
                              <?php } else { ?>
                                <th>En revisión</th>
                                <th>
                                  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="btn btn-info" href="crud/activarPubli.php?id=<?php echo $datos['idPublicacion']; ?>">Activar</a>
                                    <a class="btn btn-danger" data-toggle="modal" data-target="#eliminarPubliModal<?php echo $datos['idPublicacion'] ?>">Eliminar</a>
                                  </div>
                                </th>
                                <!-- Cierre else -->
                              <?php } ?>
                              <!--Modal Eliminar publicación -->
                              <div class="modal fade" id="eliminarPubliModal<?php echo $datos['idPublicacion'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro quieres eliminar esta publicación?</h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">Seleccione "Eliminar" para eliminar la publicación, esta acción no se podrá deshacer.</div>
                                    <div class="modal-footer">
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                      <a class="btn btn-danger" href="crud/eliminarPubli.php?id=<?php echo $datos['idPublicacion'] ?>">Eliminar</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </tr>
                        <?php

                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- Footer -->
            <?php require_once '../assets/footer.php' ?>
          </div>
        </body>

        </html>
<?php
      } else {
        echo "<script>alert('No puedes acceder a esta página con el rol que tienes');</script>";
        echo "<script> document.location.href='dashboard.php';</script>";
      }
    } else {
      echo "<script>alert('Has perdido acceso a este rol');</script>";
      echo "<script> document.location.href='403.php';</script>";
    }
  } else {
    echo "<script> document.location.href='403.php';</script>";
  }
} else {
  echo "<script> document.location.href='403.php';</script>";
}
?>