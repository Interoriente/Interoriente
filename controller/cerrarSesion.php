<?php
session_start();//Se necesita para que el session_destroy funciona, de lo contrario no se destrirá la sesión.
session_destroy();
echo "<script> document.location.href='../view/navegacion/iniciarsesion.php';</script>";