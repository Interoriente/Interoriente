<?php
    session_start();
    $rol=$_SESSION['rolUsuario'];
    if($rol==1){
        $rol=2;
        $nombreRol="Empleado";
        $_SESSION['nombreRol']=$nombreRol;       
    }
    else if($rol==2){
        $rol=3;
        $nombreRol="Administrador";
        $_SESSION['nombreRol']=$nombreRol;
    }
    else{
        $rol=1;
        $nombreRol="Comprador";
        $_SESSION['nombreRol']=$nombreRol;
    }
    echo "<script>alert('El Rol ha sido cambiado a ".$nombreRol."');</script>";
    $_SESSION['rolUsuario']=$rol;
    echo "<script> document.location.href='dashboard.php';</script>";
?>