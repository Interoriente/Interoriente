<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$arr = ["cama", "madera"];

print_r(buscarElemento($arr, 1));

function buscarElemento($keyWord, $val)
{
    require '../../dao/conexion.php';
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
                    $strSql .= "^$keyWord[$i]$|";
                } else {
                    $strSql .= "^$keyWord[$i]$";
                }
            }
        } else {
            $strSql = $keyWord[0];
        }
        $sql = "CALL sp_busquedaPublicacion(:keyword_T, :keyword_D)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':keyword_T', $strSql);
        $stmt->bindValue(':keyword_D', $keyWord[0]);
    }
   
    $stmt->execute();
    $res = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    return $res;
}
