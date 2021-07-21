<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
    <meta name="author" content="Inter-oriente">
    <title>Registrarse - Interoriente</title>
    <!-- Favicon -->
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../../users/dashboard/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../../users/dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../../users/dashboard/assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
    <?php
    //Sirve para mostrar el contenido de la tabla Ciudad, para mostrarlo en la lista desplegable
    include_once '../../dao/conexion.php';
    //Mostrar los datos almacenados
    $sql_mostrar_ciudad = "SELECT * FROM tblCiudad";
    //Prepara sentencia
    $consultar_mostrar_ciudad = $pdo->prepare($sql_mostrar_ciudad);
    //Ejecutar consulta
    $consultar_mostrar_ciudad->execute();
    $resultado_ciudad = $consultar_mostrar_ciudad->fetchAll();
    ?>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Crear cuenta</h1>
                            <p class="text-lead text-white">Aquí podrás crear una cuenta con tus datos personales.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card bg-secondary border-0">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-4"><small>Puedes registrarte por:</small></div>
                            <div class="text-center">
                                <a href="#" class="btn btn-neutral btn-icon mr-4">
                                    <span class="btn-inner--icon"><img src="../../users/dashboard/assets/img/icons/common/github.svg"></span>
                                    <span class="btn-inner--text">Github</span>
                                </a>
                                <a href="#" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src="../../users/dashboard/assets/img/icons/common/google.svg"></span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>O con tus datos personales:</small>
                            </div>
                            <form action="../../php/crud/registro.php" method="POST">
                                <div class="form-group">
                                    <label for="">Nombres:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombres" type="text" name="nombres" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Apellidos:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Apellidos" type="text" name="apellidos" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Documento:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Documento" type="number" max="9999999999" name="documento" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Teléfono:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Telefono (0pcional)" type="number" max="9999999" name="telefono">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Celular:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Celular" type="number" name="celular" max="9999999999" required>
                                    </div>
                                </div>
                                <label for="">Ciudad:</label>
                                <div class="form-group">
                                    <select name="ciudad" class="form-control" required>
                                        <option value="" disabled selected>Seleccione una ciudad</option>
                                        <?php
                                        foreach ($resultado_ciudad as $datos_ciudad) { ?>
                                            <option value="<?php echo $datos_ciudad['codigoCiudad']; ?>"><?php echo $datos_ciudad['nombreCiudad']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Correo:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Correo" type="email" name="correo" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Contraseña:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Contraseña" type="password" name="contrasena" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div>
                                <div class="row my-4">
                                    <div class="col-12">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                            <label class="custom-control-label" for="customCheckRegister">
                                                <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">Crear cuenta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a href="index.php" class="text-light"><small>Regresar a inicio</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="iniciarsesion.php" class="text-light"><small>Tienes cuenta?</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Core -->
    <script src="../../users/dashboard/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../../users/dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../users/dashboard/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../../users/dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../../users/dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="../../users/dashboard/assets/js/argon.js?v=1.2.0"></script>

</body>

</html>