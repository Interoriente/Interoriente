<?php
session_start();//Buscar explicación
session_destroy();
echo "<script> document.location.href='../principal/iniciarsesion.php';</script>";