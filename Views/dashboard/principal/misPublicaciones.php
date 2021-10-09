<?php
// Iniciar variables de sesion, obtener DocId y Rol ACTUAL del usuario
session_start();
if (!isset($_SESSION['documentoIdentidad'])) {
    echo "<script>alert('No has iniciado sesión');</script>";
    echo "<script> document.location.href='403.php';</script>";
} else {
    $documento = $_SESSION["documentoIdentidad"];
    $rol = $_SESSION['roles'];
    // Pedir clases Usuarios y Publicaciones (Iniciarlas en variables PHP)
    require "../../../Controllers/php/users/usuarios.php";
    require "../../../Controllers/php/users/publicaciones.php";
    $usuario = new Usuario($documento);
    $respUserData = $usuario->getUserData($usuario->id);

    $publicaciones = new Publicaciones($documento);
    $respMostrarPublicaciones = $publicaciones->MostrarPublicaciones($publicaciones->id);
    $contadorPublicaciones = count($respMostrarPublicaciones);
    if (isset($respUserData)) {
        if ($rol == 1) {
            //Parte superior del HTML
            require "../includes/header.php";

            require_once '../includes/sidebarDashboard.php';
            require_once '../includes/navegacion.php';
?>
            <link rel="stylesheet" href="../../assets/css/general.css">
            <link rel="stylesheet" href="../assets/css/misPublicaciones.css">
            <!-- Header -->
            <div class="header bg-primary pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <h6 class="h2 text-white d-inline-block mb-0">Mis publicaciones</h6><br>
                                <h6 class="h2 text-white d-inline-block mb-0">Total: <?php echo $contadorPublicaciones; ?></h6>
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
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table id="tabla" class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Imagen</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Costo</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <?php if (!$respMostrarPublicaciones) { ?>
                                        <tr>
                                            <th colspan="7">
                                                <div class="campo-alerta">
                                                    <div class="alerta" role="alert">Opps, por ahora no has realizado publicaciones
                                                        <h2 class="titulo-alerta">Para realizar una publicación presiona <a class="link-mensaje" href="../../navegacion/catalogos.php">aquí</a></h2>
                                                        <img class="img-caja" src="../assets/img/lupa.png" alt="">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    <?php } ?>
                                    <tbody class="list">
                                        <?php
                                        foreach ($respMostrarPublicaciones as $datosPubli) :
                                        ?>
                                            <tr>
                                                <td><img src="<?php echo $datosPubli['urlImagen'];  ?>" alt=".." width="130px"></th>
                                                <td><?php echo $datosPubli['nombrePublicacion']; ?></td>
                                                <td><?php echo substr($datosPubli['descripcionPublicacion'], 0, 50); ?>...</td>
                                                <td><?php echo $datosPubli['costoPublicacion']; ?></td>
                                                <td><?php echo $datosPubli['stockPublicacion']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="btn btn-info" data-toggle="modal" data-target="#actualizarPubliModal<?php echo $datosPubli['idPublicacion']; ?>">Actualizar</a>
                                                        <a class="btn btn-danger" data-toggle="modal" data-target="#eliminarPubliModal<?php echo $datosPubli['idPublicacion']; ?>">Eliminar</a>
                                                    </div>
                                                </td>

                                                <!--Modal Eliminar publicación -->
                                                <?php require "../includes/modalesPublicacion.php"; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
<?php require_once '../includes/footer.php';
        } else {
            echo "<script>alert('No puedes acceder a esta página');</script>";
            echo "<script> document.location.href='dashboard.php';</script>";
        }
    }
} ?>