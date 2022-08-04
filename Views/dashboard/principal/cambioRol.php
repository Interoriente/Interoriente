<?php
session_start();
if (isset($_POST['cambioRol'])) {
    if ($_POST['rol'] == '1') {
        $_SESSION['roles'] = 1;
        echo "<script> document.location.href='dashboard.php';</script>";
    } else {
        $_SESSION['roles'] = 3;
        echo "<script> document.location.href='dashboardAdmin.php';</script>";
    }
}
