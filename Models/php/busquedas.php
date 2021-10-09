<?php
if (isset($_POST['busqueda'])) {
    $res = buscarElemento($_POST['busqueda'], 0);
    echo $res;
} else {
    // No validó con elseif
    if (isset($_POST['publicacion'])) {
        $id = base64_encode($_POST['publicacion']);
        echo $id;
    } else if (isset($_POST['getResultados'])) {
        $res = buscarElemento($_POST['getResultados'], 1);
        echo $res;
    }

    //Nota: incluso si se usa decode, si es un objeto enviado desde el cliente, se debe seguir usando la notación -> para acceder
}
function buscarElemento($keyWord, $val)
{
    require '../dao/conexion.php';
    if ($val == 0) {
        //Resultados de búsqueda cuando se está escribiendo 
        $sql = "CALL sp_busquedas(:keyword)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':keyword', $keyWord);
    } else {
        //Resultados de búsqueda la búsqueda
        if (sizeof($keyWord) > 1) {
            $strSql = "";
            $arrLength = sizeof($keyWord);
            for ($i = 0; $i < $arrLength; $i++) {
                if ($i != ($arrLength -1)) {
                    $strSql .= "$keyWord[$i]|";
                } else {
                    $strSql .= $keyWord[$i];
                }
            }
        } else {
            $strSql = $keyWord[0];
        }
        $keyWordDescripcion = "$keyWord[0]$";
        $sql = "CALL sp_busquedaPublicacion(:keyword_T, :keyword_D)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':keyword_T', $strSql);
        $stmt->bindValue(':keyword_D', $keyWordDescripcion);
    }

    $stmt->execute();
    $res = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    return $res;
}
