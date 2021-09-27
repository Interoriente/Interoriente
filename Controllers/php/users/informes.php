<?php
class Informes
{
    /* Atributos */
    public int $docId;

    /* Constructor */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function ContadorStock($id)
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_contadorStock(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function MostrarVentasAnuales($id)
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_ventasAnuales(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function VentasPorDias($id)
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_ventasPorDia(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function GetPublicacionesExitosas($id){
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
}
