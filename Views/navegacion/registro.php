<!-- PHP para inicio de Sesion con Google -->
<?php
require "../assets/linksGoogle.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
    <meta name="author" content="Inter-oriente">
    <title>Registrarse | Interoriente</title>
    <!-- Favicon -->
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../dashboard/assets/css/iconos.css" type="text/css">
    <link rel="stylesheet" href="../dashboard/assets/css/iconosComplementos.css" type="text/css">
    <link rel="stylesheet" href="../dashboard/assets/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../dashboard/assets/css/argon.min.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default" oncontextmenu="return false">

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
                                <a href="<?php echo $GoogleLogin; ?>" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src="../dashboard/assets/img/google.svg"></span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>O con tus datos personales:</small>
                            </div>
                            <form action="../../Controllers/php/users/acceso.php" method="POST">
                                <input type="hidden" name="registrarse">
                                <input type="hidden" name="imagen" value="imagenes/NO_borrar.png">
                                <div class="form-group">
                                    <label for="">Nombres:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombres" type="text" name="nombres" onkeypress="return Sololetras(event)" required autofocus>
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
                                    <label for="">Correo:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="tuemail@email.com" type="email" name="correo" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Contraseña:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="*********" type="password" name="contrasena" minlength="5" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Repita contraseña:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="*********" type="password" name="recontrasena" minlength="5" maxlength="20" required>
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
    <!-- Argon JS -->
    <script src="../dashboard/assets/js/argon.min.js?v=1.2.0"></script>


</body>

</html>