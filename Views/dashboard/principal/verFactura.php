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
}
if (isset($respUserData)) {
    if ($rol == 1 or $rol == 3) {

        //Parte superior del HTML
        require "../assets/header.php";

        require_once '../assets/sidebarDashboard.php';
        require_once '../assets/navegacion.php'; ?>
        
        <!-- Footer -->
        <?php require_once '../assets/footer.php' ?>
        </div>
        </body>

        </html>
<?php
    } else {
        echo "<script>alert('No puedes acceder a esta página!');</script>";
        echo "<script> document.location.href='403.php';</script>";
    }
} else {
    echo "<script>alert('No has iniciado sesión');</script>";
    echo "<script> document.location.href='403.php';</script>";
}

?>