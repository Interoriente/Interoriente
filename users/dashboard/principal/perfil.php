<?php
session_start();

if (isset($_SESSION["documentoIdentidad"])) {
  include_once 'crud/consultas.php';

  //Llamado tabla publicación
  $sqlSesionPubli = "SELECT * FROM tblPublicacion WHERE docIdentidadPublicacion=?";
  $consultaSesionPubli = $pdo->prepare($sqlSesionPubli);
  $consultaSesionPubli->execute(array($documento));
  $resultadoSesionPubli = $consultaSesionPubli->rowCount();
  //Validacion de roles
  if ($contadorValidacion) {
    if ($resultadoSesionRol) {
      if ($sesionRol == '1' or $sesionRol == '2' or $sesionRol == '3') {
?>
        <!DOCTYPE html>
        <html>

        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
          <meta name="author" content="Inter-oriente">
          <title>Mi perfil | Interoriente</title>
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

          //Llamado a tabla Direcciones
          include_once '../../../dao/conexion.php';
          //Mostrar los datos almacenados
          $sqlDireccion = "SELECT DI.idDireccion,DI.nombreDireccion,DI.descripcionDireccion,CI.nombreCiudad,CI.idCiudad 
          FROM tblDirecciones as DI
          INNER JOIN tblCiudad as CI ON DI.ciudadDireccion=CI.idCiudad
          WHERE docIdentidadDireccion=?";
          //Prepara sentencia
          $consultarDireccion = $pdo->prepare($sqlDireccion);
          //Ejecutar consulta
          $consultarDireccion->execute(array($documento));
          $resultadoDireccion = $consultarDireccion->fetchAll();

          //Llamado tabla ciudad
          //Sirve para mostrar el contenido de la tabla Ciudad, para mostrarlo en la lista desplegable

          //Mostrar los datos almacenados
          $sqlCiudad = "SELECT * FROM tblCiudad";
          //Prepara sentencia
          $consultarCiudad = $pdo->prepare($sqlCiudad);
          //Ejecutar consulta
          $consultarCiudad->execute();
          $resultadoCiudad = $consultarCiudad->fetchAll();

          //Mostrar la información del usuario logueado
          $sqlMostrarUsu = "SELECT*FROM tblUsuario WHERE documentoIdentidad =? ";
          $consultaMostrarUsu = $pdo->prepare($sqlMostrarUsu);
          $consultaMostrarUsu->execute(array($documento));
          $resultadoMostrarUsu = $consultaMostrarUsu->rowCount();
          $resultadoObjeMostrar = $consultaMostrarUsu->fetch(PDO::FETCH_OBJ);

          //Validacion de roles
          if ($resultadoMostrarUsu) {
            $nombreUsuario = $resultadoObjeMostrar->nombresUsuario . " " . $resultadoObjeMostrar->apellidoUsuario;
          ?>
            <!-- Header -->
            <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../../../assets/img/fondoperfil.jpg); background-size: cover; background-position: center top;">
              <!-- Mask -->
              <span class="mask bg-gradient-default opacity-8"></span>
              <!-- Header container -->
              <div class="container-fluid d-flex align-items-center">
                <div class="row">
                  <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hola! <?php echo $resultadoObjeMostrar->nombresUsuario ?></h1>
                    <p class="text-white mt-0 mb-5">Esta es tu página de perfil. Podrás visualizar tu información y actualizarla en cualquier momento.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Page content -->
            <div class="container-fluid mt--6">
              <div class="row">
                <div class="col-xl-4 order-xl-2">
                  <div class="card card-profile">
                    <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                      <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                          <a data-toggle="modal" data-target="#fotoperfil">
                            <img src="crud/<?php echo $objetoLlamado->imagenUsuario; ?>" class="rounded-circle">
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-8 pb-5 pb-md-0">
                      <div class="d-flex justify-content-between">
                        <a href="#!" class="btn btn-sm btn-info  mr-4 ">Ayuda</a>
                      </div>
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col">
                          <div class="card-profile-stats d-flex justify-content-center">
                            <div>
                              <span class="heading"><?php echo $resultadoSesionPubli; ?></span>
                              <span class="description">Publicaciones</span>
                            </div>
                            <div>
                              <span class="heading">0</span>
                              <span class="description">Fotos</span>
                            </div>
                            <div>
                              <span class="heading">89</span>
                              <span class="description">Comentarios</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="text-center">
                        <h5 class="h3">
                          <?php echo $nombreUsuario; ?><span class="font-weight-light">, 27</span>
                        </h5>
                        <div class="h5 font-weight-300">
                          <i class="ni location_pin mr-2"></i>Oriente de Antioquia
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal" id="fotoperfil" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <img class=" card-img-top" src="crud/<?php echo $objetoLlamado->imagenUsuario; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <!--/Modal -->

                <div class="col-xl-8 order-xl-1">
                  <div class="card">
                    <div class="card-header">
                      <div class="row align-items-center">
                        <div class="col-8">
                          <h3 class="mb-0">Editar perfil </h3>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <form action="crud/actualizarCuenta.php" method="POST" enctype="multipart/form-data">
                        <h6 class="heading-small text-muted mb-4">Información de usuario</h6>
                        <div class="pl-lg-4">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="docu">Documento</label>
                                <input type="text" id="docu" name="nombre" class="form-control" placeholder="Username" value="<?php echo $resultadoObjeMostrar->documentoIdentidad; ?>" disabled required>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Nombre</label>
                                <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $resultadoObjeMostrar->nombresUsuario; ?>" required disabled>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Apellido</label>
                                <input type="text" id="input-username" name="apellido" class="form-control" placeholder="Apellido" value="<?php echo $resultadoObjeMostrar->apellidoUsuario; ?>" required disabled>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Celular</label>
                                <input type="number" id="input-username" name="celular" class="form-control" placeholder="Celular" max="9999999999" value="<?php echo $resultadoObjeMostrar->telefonomovilUsuario; ?>" required>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-email">Correo</label>
                                <input type="email" id="input-email" name="correo" class="form-control" value="<?php echo $resultadoObjeMostrar->emailUsuario; ?>" required>
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
                              <input type="hidden" name="ideditar" value="<?php echo $resultadoObjeMostrar->documentoIdentidad; ?>" required>
                            </div>
                          </div>
                          <button class="btn btn-primary btn-xs" type="submit" name="subir">Editar</button>
                        </div>
                      </form>
                    </div>
                    <!-- Formulario para agregar direcciones -->
                    <div class="card-body">
                      <form action="crud/agregarDirecciones.php" method="POST" enctype="multipart/form-data">
                        <h6 class="heading-small text-muted mb-4">Información de direcciones agregadas</h6>
                        <div class="pl-lg-4">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="nombre">Nombre (Opcional)</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Madre, Casa, Trabajo..." value="">
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="direccion">Dirección</label>
                                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Cra ###" value="" required>
                                <!-- Capturo el documento del usuario logueado -->
                                <input type="hidden" id="direccion" name="documento" class="form-control" value="<?php echo $documento; ?>" required>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="ciudad">Ciudad de la dirección</label>
                                <select name="ciudad" id="ciudad" class="form-control">
                                  <option value="" disabled>Seleccione una ciudad</option>
                                  <?php foreach ($resultadoCiudad as $ciudad) {
                                  ?>
                                    <option value="<?php echo $ciudad['idCiudad'] ?>"><?php echo $ciudad['nombreCiudad'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <button class="btn btn-primary btn-xs" type="submit" name="subirDireccion">Registrar</button>
                        </div>
                      </form>
                    </div>

                    <center>
                      <h1>Mis Direcciones</h1>
                    </center>
                    <div class="table-responsive">
                      <table id="tabla" class="table align-items-center table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <?php
                        foreach ($resultadoDireccion as $direccion) {
                        ?>
                          <tr>
                            <td><?php echo $direccion['nombreDireccion']; ?></td>
                            <td><?php echo $direccion['descripcionDireccion'] ?></td>
                            <td><?php echo $direccion['nombreCiudad'] ?></td>
                            <td>
                              <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Acciones
                              </button>
                              <div class="dropdown-menu">
                                <a class="btn btn-info" data-toggle="modal" data-target="#actualizarDirModal<?php echo $direccion['idDireccion'] ?>">Actualizar</a>
                                <a class="btn btn-danger" data-toggle="modal" data-target="#eliminarDirModal<?php echo $direccion['idDireccion'] ?>">Eliminar</a>
                              </div>
                            </td>

                            <!--Modal Eliminar direccion -->
                            <div class="modal fade" id="eliminarDirModal<?php echo $direccion['idDireccion'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro quieres eliminar esta dirección?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">Seleccione "Eliminar" para eliminar la dirección, esta acción no se podrá deshacer.</div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                    <a class="btn btn-danger" href="crud/eliminarDireccion.php?id=<?php echo $direccion['idDireccion'] ?>">Eliminar</a>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Modal para actualizar direcciones -->
                            <div class="modal fade" id="actualizarDirModal<?php echo $direccion['idDireccion'] ?>" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Actualizar Dirección</h4>
                                    <button type="button" class="close" data-dismiss="modal">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>

                                  <!-- Modal Body -->
                                  <div class="modal-body">
                                    <p class="statusMsg"></p>
                                    <form method="POST" action="crud/actualizarDireccion.php">
                                      <div class="form-group">
                                        <label for="inputName">Nombre</label>
                                        <input type="text" class="form-control" id="inputName" name="nombre" placeholder="Nombre" value="<?php echo $direccion['nombreDireccion'] ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="inputDireccion">Dirección</label>
                                        <input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder="Dirección" value="<?php echo $direccion['descripcionDireccion'] ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="inputCiudad">Ciudad</label>
                                        <select name="ciudad" id="ciudad" class="form-control">
                                          <option value="<?php echo $direccion['idCiudad'] ?>"><?php echo $direccion['nombreCiudad'] ?></option>
                                          <?php foreach ($resultadoCiudad as $ciudad) {
                                          ?>
                                            <option value="<?php echo $ciudad['idCiudad'] ?>"><?php echo $ciudad['nombreCiudad'] ?></option>
                                          <?php } ?>
                                        </select>
                                        <!-- Capturo id dirección a editar -->
                                        <input type="hidden" name="id" value="<?php echo $direccion['idDireccion']; ?>">
                                      </div>



                                      <!-- Modal Footer -->
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary submitBtn">Actualizar</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Fin modal -->
                          </tr>
                        <?php } //Fin foreach
                        ?>
                      </table>
                    </div>

                  </div>
                </div>
              <?php } ?>
              </div>
            </div>
            <!-- Footer -->
            <?php require_once '../assets/footer.php' ?>

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