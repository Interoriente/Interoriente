<?php

// Iniciar variables de sesion, obtener DocId y Rol ACTUAL del usuario
session_start();
$respUserData = null;
if (isset($_SESSION['documentoIdentidad'])) {
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
}
//Validar si existe sesión
if (isset($respUserData)) {
    if ($rol == 1) {
        //Parte superior del HTML
        require "../includes/header.php";

        require_once '../includes/sidebarDashboard.php';
        require_once '../includes/navegacion.php';
?>
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
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Costo</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$respMostrarPublicaciones) { ?>
                                        <tr>
                                            <td colspan="8">
                         <div class="campo-alerta">
                        <div class="alerta" role="alert">Ops, por ahora no has hecho publicaciones
                        <a class="link-mensaje" href="crearPublicacion.php">Para realizar una publicación empieza da click aquí...</a>

                        <style>
                            .link-mensaje{
                            font-size: 30px;
                            }
                            .campo-alerta{
                            display: flex;
                            flex-flow: row;
                            justify-content: center;
                            align-items: center;
                            width: 100%;
                            height: 760px;
                            }
                            .alerta{
                            display: flex;
                            flex-flow: column;
                            justify-content: space-around;
                            justify-content: center;
                            align-items: center;
                            color: black;
                            font-size: 40px;
                            width: 80%;
                            height: 80%;
                            background: #D1CED9;
                            }
                            .fa-sad-tear{
                            font-size: 500%;
                            color: #9B99A1;
                            }
                            .campo-boton{
                            display: flex;
                            flex-flow: row;
                            justify-content: center;
                            width: 100%;
                            height: 100px;
                            }
                            .btn-infoo {
                            width: 200px;
                            height: 50px;
                            color: #fff;
                            border-color: #11cdef;
                            background-color: #11cdef;
                            box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08)
                    }
                        </style>
                        <i class="fas fa-sad-tear"></i>
                    </div>
                    </div>                                                
                                            </td>
                                        </tr>
                                </tbody>

                                <tr>
                                <?php }
                                    foreach ($respMostrarPublicaciones as $datosPubli) {
                                ?>
                                    <th><img src="<?php echo $datosPubli['urlImagen'];  ?>" alt=".." width="130px"></th>
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
                            <?php } ?>
                            </table>
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
} else {
    echo "<script>alert('No has iniciado sesión');</script>";
    echo "<script> document.location.href='403.php';</script>";
}
    ?>