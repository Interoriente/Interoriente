<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estiCatalogo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
    <title>Catálogo</title>
</head>
<body background="../../assets/img/fondocatalogo.jpg">
    <div class="padre">
        <?php
        include '../includes/navSuperior.php';
        ?>
        <div class="header">
            <div class="contenedor-menu">
                <div class="menuuno"><a href="#">
                    <i class="fas fa-box-open"></i>
                    <h1 class="tit-menu">Productos</h1>
                    <p class="par-menu">Ejemplo: Libros...</p>  
                </a>    
                </div>
            
                <div class="menuuno"><a href="#">
                    <i class="fas fa-cogs"></i>                    
                    <h1 class="tit-menu">Servicios</h1>
                    <p class="par-menu">Ejemplo: Reparación...</p>  
                </a>    
                </div>  
            </div>
            <div class="contenedor-regresar">
                <a href="#"><button class="BotonRegresar">Regresar</button></a>            
            </div>
        </div>
    </div>
    <?php include '../includes/navInferior.php'; ?>
    <!-- Barra de navegación para dispositivos móviles -->
    <?php
    include '../includes/navMovil.php';
    ?>
</body>
</html>