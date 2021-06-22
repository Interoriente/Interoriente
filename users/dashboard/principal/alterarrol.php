<?php
    session_start();
    $rol=$_SESSION['rolUsuario'];
    if($rol==1){
        $rol=2;
        echo "<script>alert('El Rol ha sido cambiado a Vendedor');</script>";
    }
    else {
        $rol=1;
        echo "<script>alert('El Rol ha sido cambiado a Comprador');</script>";
    }
    $_SESSION['rolUsuario']=$rol;
    echo "<script> document.location.href='dashboard.php';</script>";
?>