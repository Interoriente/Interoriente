<?php
// Iniciar variables de sesion, obtener DocId y Rol ACTUAL del usuario
session_start();
$respUserData = null;
if (isset($_SESSION['documentoIdentidad'])) {
    $documento = $_SESSION["documentoIdentidad"];
    $rol = $_SESSION['roles'];
    // Pedir clases Usuarios y Publicaciones (Iniciarlas en variables PHP)
    require "../../../Controllers/php/users/usuarios.php";
    $usuario = new Usuario($documento);
    $respUserData = $usuario->getUserData($usuario->id);
    require "../../../Controllers/php/users/compras.php";
    $compra = new Compra($documento);
    $respComprasData = $compra->misCompras($compra->id);
    $contadorCompras = count($respComprasData);
}
if (isset($respUserData)) {
    if ($rol == 1 or $rol == 3) {

        //Parte superior del HTML
        require "../includes/header.php";

        require_once '../includes/sidebarDashboard.php';
        require_once '../includes/navegacion.php'; ?>
    
        <!-- Link estilos -->
        <link rel="stylesheet" href="../../assets/css/general.css">
        <link rel="stylesheet" href="../assets/css/misCompras.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <!-- Header -->
        <div class="header bg-primary pb-3">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center">
                        <h6 class="h2 text-white d-inline-block mb-0" style="text-align: center;">Productos adquiridos</h6><br>
                    </div>
                </div>
            </div>
        </div>
        <!-- Productos comprados -->
        <?php if ($contadorCompras == 0) { ?>
            <div class="alerta" role="alert" style="display: flex; flex-flow: row; flex-wrap: wrap; background: crimson; width:100%; height: 200px; text-align: center; justify-content: center; align-items: center; color: white; font-size: 25px; ">Ops, por no ahora no has realizado compras
            <i class="fa-regular fa-face-sad-tear"></i>        
        </div>
            <a class="btn btn-info" href="../../navegacion/index.php">Ver Productos</a>
        <?php } ?>
        <div class="padre">
            <div class="header">
                <div class="contenedores-menu">
                    <?php foreach ($respComprasData as $misCompras) {
                    ?>
                        <div class="menu-menu">
                            <div class="menu-principal">
                                <div class="cont-menuuno">
                                    <img class="imagen-cont" src="<?php echo $misCompras['urlImagen']; ?>" alt="">
                                </div>
                                <div class="cont-menudos">
                                    <h2 class="titulo-nombre"><?php echo $misCompras['nombrePublicacion']; ?></h2>
                                    <h2 class="titulo-costo">$<?php echo $misCompras['costoPublicacion']; ?></h2>
                                    <p class="textos">Cantidad: <?php echo $misCompras['cantidad']; ?></p>
                                    <p class="textos"><a target="_blank" href="<?php echo "https://api.whatsapp.com/send?phone=57".$misCompras['telefono'];?>">WhatsApp</a><p>
                                    <p class="textos"><?php echo $misCompras['fecha']; ?></p>
                                </div>
                                <div class="cont-menutres">
                                    <button class="boton-menu">Volver a comprar</button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Footer -->
<?php  require_once '../includes/footer.php';
    } else {
        echo "<script>alert('No puedes acceder a esta página!');</script>";
        echo "<script> document.location.href='403.php';</script>";
    }
} else {
    echo "<script>alert('No has iniciado sesión');</script>";
    echo "<script> document.location.href='403.php';</script>";
}

?>