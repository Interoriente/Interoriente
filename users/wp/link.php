<?php
    if($_POST){
        $numero = strip_tags($_POST['numero']);
        $texto = strip_tags($_POST['texto']);
        $link = "https://api.whatsapp.com/send?phone=57$numero&text=$texto";

        header("Status: 301 Moved Permanently");
        header("Location: https://api.whatsapp.com/send?phone=57$numero&text=$texto");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>  

</body>
</html>