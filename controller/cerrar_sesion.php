<?php
session_start();
session_destroy();
echo "<script> document.location.href='../principal/iniciarsesion.php';</script>";