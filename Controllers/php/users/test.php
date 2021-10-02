<?php
/* $resultado = consulta();
$img = [];
foreach ($resultado as $publi) {
 array_push($img, $publi["urlImagen"]);
} */
/* print_r($img); */
/* print_r($resultado);
 */

/* print_r(ContadorStock(123456789));
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* echo exitosas(123456789); */

/* print_r(AlertaStock(123456789));
$stock = AlertaStock(123456789); */
/* echo $stock["No_publicaciones"]; */


print_r(VentasMensual(123456789));
function VentasMensual($id)
{
    require "../../../Models/dao/conexion.php";
    $reporte = ["TotalMesActual" => null, "Porcentaje" => null];
    $objReporte = (object) $reporte;
    $porcentaje = 0;
    $sql = "CALL sp_totalMensual(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $totalMesActual = $stmt->fetch(PDO::FETCH_ASSOC);
    $sql = "CALL sp_totalMesPasado(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $totalMesPasado = $stmt->fetch(PDO::FETCH_ASSOC);
    $calculoPorcentaje = ($totalMesActual["Total"] * 100) / $totalMesPasado["Total"];

    if ($calculoPorcentaje < 100) {
        $porcentaje = 100 - $calculoPorcentaje;
    } else {
        if ($calculoPorcentaje > 100) {
            $porcentaje = $calculoPorcentaje - 100;
        }
    }

    $objReporte->TotalMesActual = $totalMesActual["Total"];
    $objReporte->Porcentaje = round($porcentaje, 2);
    return $objReporte;
}

function AlertaStock($id)
{
    require "../../../Models/dao/conexion.php";
    $sql = "CALL sp_alertaStock(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function exitosas($id)
{
    require "../../../Models/dao/conexion.php";
    /*     $ids = [93, 133, 172, 97, 157]; */
    $reporte = [
        'Ids' => null, 'Titulos' => null, 'NoVentas' => null,
        "VlrVentas" => null, "Stock" => null, "Porcentajes" => null
    ];
    $totalPublicacion = 0;
    $objReporte = (object) $reporte;
    $ids = [];
    $titulos = [];
    $NoVentas = [];
    $TotalVentas = [];
    $Stock = [];
    $totsPublicaciones = [];
    $porcentajes = [];
    $sql = "CALL sp_publicacionesMasExitosas(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $masExitosas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($masExitosas as $publicacion) {
        array_push($ids, $publicacion['Id']);
        array_push($titulos, $publicacion['Titulo']);
        array_push($NoVentas, $publicacion['CantidadVentas']);
        array_push($TotalVentas, $publicacion['VlrVentas']);
        array_push($Stock, $publicacion['Stock']);
    }
    $objReporte->Ids = $ids;
    $objReporte->Titulos = $titulos;
    $objReporte->NoVentas = $NoVentas;
    $objReporte->VlrVentas = $TotalVentas;
    $objReporte->Stock = $Stock;

    foreach ($ids as $index) {
        $sqlPorcentaje = "SELECT SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS 'Total'
        FROM tblPublicacion as PU
        INNER JOIN tblFacturaPublicacion AS FP 
        ON PU.idPublicacion = FP.idPublicacionFactura
        WHERE PU.idPublicacion = $index
        GROUP BY FP.idPublicacionFactura;";
        $stmt = $pdo->prepare($sqlPorcentaje);
        $stmt->execute();
        array_push($totsPublicaciones, $stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    /* Regla de 3:
    1. Obtener Total (TG)
    2. Obtener el Total de la publicación (TP)
    3. Multiplicar TP * 100 / TG;
    */
    $sqlTotalG = "SELECT SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS 'Total'
    FROM tblPublicacion as PU
    INNER JOIN tblFacturaPublicacion AS FP 
    ON PU.idPublicacion = FP.idPublicacionFactura
    WHERE PU.docIdentidadPublicacion = $id";
    $stmtTotalG = $pdo->prepare($sqlTotalG);
    $stmtTotalG->execute();
    $totalGeneral = $stmtTotalG->fetchAll(PDO::FETCH_ASSOC);
    /*    $r = simplificarArreglo($totalGeneral); */
    $totalGeneral = $totalGeneral[0]["Total"];
    /*  foreach ($totsPublicaciones as $x) {
        $totalPublicacion += $x;
    } */
    for ($i = 0; $i < count($totsPublicaciones); $i++) {
        $calculo = ($totsPublicaciones[$i][0]["Total"] * 100) / $totalGeneral;
        array_push($porcentajes, $calculo);
    }

    //Al final
    $objReporte->Porcentajes = $porcentajes;
    return $objReporte;
}






function ContadorStock($id)
{
    require "../../../Models/dao/conexion.php";
    $sql = "CALL sp_contadorStock(:id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function consulta()
{
    require('../../../Models/dao/conexion.php');
    $sql = "SELECT IMG.urlImagen,PU.idPublicacion,PU.nombrePublicacion,PU.descripcionPublicacion,
    PU.costoPublicacion,PU.stockPublicacion,PU.validacionPublicacion
    FROM tblPublicacion as PU
    INNER JOIN tblImagenes as IMG 
    ON PU.idPublicacion = IMG.publicacionImagen
    WHERE validacionPublicacion='1'
/*     GROUP BY PU.idPublicacion */
    ORDER BY rand()
    LIMIT 5";

    $consulta = $pdo->prepare($sql);   /* PDO statement-> Ejecutarlo */
    /* Ejecución de la consulta */
    $consulta->execute();
    /* Obteniendo resultado de tipo objeto (Arreglo) */
    return $consulta->fetchAll(PDO::FETCH_NAMED);
}
