<?php
//TODO Organizar en Archivos Separados e Incluirlos 
ini_set('display_errors', 1);
require_once "../../dao/conexion.php";

ini_set('display_errors', 1);
session_start(); //No debería iniciar la sesión

$stmt = $pdo->prepare("SELECT * FROM tblPublicacion WHERE idPublicacion = 4");
$stmt->execute();
$producto = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Consulta tblCarrito
$stmt = $pdo->prepare("SELECT idPublicacion FROM tblCarrito");
$stmt->execute();
$consultaCarrito = $stmt->fetch(PDO::FETCH_OBJ);
$queryCarrito = $consultaCarrito->idPublicacion;

//Condicionales de Control
if ($_GET) {
    if (session_status() == PHP_SESSION_NONE) { //Verifica que la existencia de la sesión
        //En caso de que no exista
        header("Location: ../navegacion/registro.php");
    } else {
        $id = $_GET['agregar'] ?? '';
        $cantidad = $_GET['cantidad'] ?? 1;
        $docId = $_SESSION['documentoIdentidad'];
        if (isset($id) && isset($cantidad)) {

            $stmt = $pdo->prepare("INSERT INTO tblCarrito VALUES (null, :id, :docId, :cantidad)");
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':docId', $docId);
            $stmt->bindValue(':cantidad', $cantidad);
            $stmt->execute();
            header("Location: ../../principal/publicacion/index.php");
        }
    } //Fin if de control
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Interoriente- Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">SKU: BST-498</div>
                    <?php foreach ($producto as $resultado) : ?>
                        <h1 class="display-5 fw-bolder"><?php echo $resultado['nombrePublicacion'] ?></h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">$425</span>
                            <span>$<?php echo $resultado['costoPublicacion'] ?></span>
                        </div>
                        <p class="lead"><?php echo $resultado['descripcionPublicacion'] ?></p>
                        <div class="d-flex">


                            <?php if ($queryCarrito != $resultado['idPublicacion']) { ?>
                                <form method="GET">
                                    <input class="form-control text-center me-3" id="inputQuantity" type="number" name="cantidad" style="max-width: 3rem" />
                                    <button name="agregar" value="<?php echo $resultado['idPublicacion'] ?>" class="btn btn-outline-dark flex-shrink-0" type="submit">
                                        <i class="bi-cart-fill me-1"></i>
                                        Agregar al carrito
                                    </button>
                                </form>
                            <?php }else { ?>
                                <form method="POST" action="../../php/crud/procesoCompras/consultasPublicacion.php">
                                    <button type= "hidden" name="eliminar" value="<?php echo $resultado['idPublicacion'] ?>" class="btn btn-outline-dark flex-shrink-0" type="submit">
                                        <i class="bi-cart-fill me-1 bg-red"></i>
                                        Eliminar del Carrito
                                    </button>
                                </form>

                            <?php } ?>



                        <?php endforeach; ?>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>