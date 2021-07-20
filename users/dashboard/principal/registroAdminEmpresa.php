<?php
session_start();

if (isset($_SESSION["emailUsuario"]) or isset($_SESSION["documentoIdentidad"])) {
    $id = $_SESSION["emailUsuario"];
    $sesionRol = $_SESSION['roles'];
    include_once '../../../dao/conexion.php';
    $sql_validacion = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' AND estadoUsuario= '1'";
    $consulta_resta_validacion = $pdo->prepare($sql_validacion);
    $consulta_resta_validacion->execute();
    $resultado_validacion = $consulta_resta_validacion->rowCount();
    $validacion = $consulta_resta_validacion->fetch(PDO::FETCH_OBJ);
    //Llamado tabla intermedia
    $documento = $_SESSION["documentoIdentidad"];
    $sqlSesionRol = "SELECT * FROM tblUsuarioRol WHERE docIdentidad=? AND idRol=?";
    $consultaSesionRol = $pdo->prepare($sqlSesionRol);
    $consultaSesionRol->execute(array($documento, $sesionRol));
    $resultadoSesionRol = $consultaSesionRol->rowCount();
    //Llamado a documento del usuario logueado
    $idDoc = $_SESSION["documentoIdentidad"];

    //Llamado a tabla empresa, función: contar registros
    $documentoRepresen = $_SESSION['documentoIdentidad'];
    $sqlMostrarEmpresa = "SELECT * FROM tblEmpresa WHERE documentoRepresentante=?";
    //Prepara sentencia
    $consultarMostrarEmpresa = $pdo->prepare($sqlMostrarEmpresa);
    //Ejecutar consulta
    $consultarMostrarEmpresa->execute(array($idDoc));
    $contadorEmpresa = $consultarMostrarEmpresa->rowCount();

    //Validacion de roles
    if ($resultado_validacion) {
        if ($resultadoSesionRol) {
            if (!$contadorEmpresa) {
                if ($sesionRol == '1') {
?>
                    <!DOCTYPE html>
                    <html>

                    <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                        <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
                        <meta name="author" content="Inter-oriente">
                        <title>Crear empresa - Interoriente</title>
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
                        <?php if ($_SESSION['roles'] == '1') {
                            require_once '../assets/sidebarCom.php';
                        } else if ($_SESSION['roles'] == '2') {
                            require_once '../assets/sidebarEmpre.php';
                        } else {
                            require_once '../assets/sidebarAdmin.php';
                        } ?>
                        <?php require_once '../assets/header.php';

                        //Sirve para mostrar el contenido de la tabla Ciudad, para mostrarlo en la lista desplegable
                        include_once '../../../dao/conexion.php';
                        //Mostrar los datos almacenados
                        $sql_mostrar_ciudad = "SELECT * FROM tblCiudad";
                        //Prepara sentencia
                        $consultar_mostrar_ciudad = $pdo->prepare($sql_mostrar_ciudad);
                        //Ejecutar consulta
                        $consultar_mostrar_ciudad->execute();
                        $resultado_ciudad = $consultar_mostrar_ciudad->fetchAll();


                        if ($_GET) {
                            include_once '../../../dao/conexion.php';
                            //Cargar los datos del id seleccionado
                            $idpubli = $_GET["id"];
                            //Mostrar los datos almacenados
                            $sql_mostrar_publi1 = "SELECT * FROM tblPublicacion WHERE idPublicacion ='$idpubli'";
                            //Prepara sentencia
                            $consultar_mostrar_publi1 = $pdo->prepare($sql_mostrar_publi1);
                            //Ejecutar consulta
                            $consultar_mostrar_publi1->execute(array($idpubli));
                            $resultado_mostrar_publi1 = $consultar_mostrar_publi1->fetch();
                        }
                        ?>
                        <br><br><br><br>
                        <!-- Formulario crear empresa -->
                        <div class="container-fluid mt--6">
                            <div class="row">
                                <div class="col-xl-8 order-xl-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h3 class="mb-0">Crear Empresa</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="crud/registroAdminEmpresa.php" method="POST" enctype="multipart/form-data">
                                                <h6 class="heading-small text-muted mb-4">Datos de la empresa</h6>
                                                <div class="pl-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">NIT</label>
                                                                <input type="text" id="input-username" name="nit" class="form-control" placeholder="NIT" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">Nombre</label>
                                                                <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">Descripción</label>
                                                                <input type="text" id="input-username" name="descripcion" class="form-control" placeholder="Descripción" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">Correo</label>
                                                                <input type="email" id="input-username" name="correo" class="form-control" placeholder="Correo" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">Imagen</label>
                                                                <input type="file" id="input-username" name="file" class="form-control" placeholder="Imagen" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">Dirección</label>
                                                                <input type="text" id="input-username" name="direccion" class="form-control" placeholder="Dirección" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">Ciudad</label>
                                                                <select name="ciudad" class="form-control" required>
                                                                    <option value="" disabled selected>Seleccione una ciudad</option>
                                                                    <?php
                                                                    foreach ($resultado_ciudad as $datos_ciudad) { ?>
                                                                        <option value="<?php echo $datos_ciudad['codigoCiudad']; ?>"><?php echo $datos_ciudad['nombreCiudad']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">Teléfono</label>
                                                                <input type="number" id="input-username" name="telefono" class="form-control" placeholder="Teléfono" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="hidden" id="input-username" name="usuario" class="form-control" placeholder="Usuario" value="<?php echo $idDoc; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary btn-xs" type="submit" name="subir">Registrar empresa</button>
                                                </div>
                                            </form>
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
                echo "<script>alert('Error! Ya tienes empresa');</script>";
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