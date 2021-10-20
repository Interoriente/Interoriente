<?php

class Informes
{
    /* Atributos */
    public int $id;

    /* Constructor */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function ContadorStock($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_contadorStock(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function MostrarVentasAnuales($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_ventasAnuales(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function VentasPorDias($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_ventasPorDia(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function GetPublicacionesExitosas($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $reporte = [
                'Ids' => null, 'Titulos' => null, 'NoVentas' => null,
                "VlrVentas" => null, "Stock" => null, "Porcentajes" => null
            ];
            $objReporte = (object) $reporte;
            $ids = [];
            $titulos = [];
            $NoVentas = [];
            $TotalVentas = [];
            $Cantidad = [];
            $totsPublicaciones = [];
            $porcentajes = [];
            $sql = "CALL sp_publicacionesMasExitosas(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $masExitosas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            foreach ($masExitosas as $publicacion) {
                array_push($ids, $publicacion['Id']);
                array_push($titulos, $publicacion['Titulo']);
                array_push($NoVentas, $publicacion['CantidadVentas']);
                array_push($TotalVentas, $publicacion['VlrVentas']);
                array_push($Cantidad, $publicacion['Cantidad']);
            }

            $objReporte->Ids = $ids;
            $objReporte->Titulos = $titulos;
            $objReporte->NoVentas = $NoVentas;
            $objReporte->VlrVentas = $TotalVentas;
            $objReporte->Cantidad = $Cantidad;
            foreach ($ids as $index) {
                $sqlPorcentaje = "SELECT SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS 'Total'
                FROM tblPublicacion as PU
                INNER JOIN tblFacturaPublicacion AS FP 
                ON PU.idPublicacion = FP.idPublicacionFactura
                WHERE PU.idPublicacion = :id
                GROUP BY FP.idPublicacionFactura";
                $stmtPorcentaje = $pdo->prepare($sqlPorcentaje);
                $stmtPorcentaje->bindValue(':id', $index);
                $stmtPorcentaje->execute();
                array_push($totsPublicaciones, $stmtPorcentaje->fetchAll(PDO::FETCH_ASSOC));
            }
            /* Regla de 3:
            1. Obtener Total (TG)
            2. Obtener el Total de la publicación (TP)
            3. Multiplicar TP * 100 / TG; */
            $sqlTotalG = "CALL sp_totalGeneral (:id)";
            $stmtTotalG = $pdo->prepare($sqlTotalG);
            $stmtTotalG->bindValue(":id", $id);
            $stmtTotalG->execute();
            $totalGeneral = $stmtTotalG->fetchAll(PDO::FETCH_ASSOC);
            $totalGeneral = $totalGeneral[0]["Total"];
            for ($i = 0; $i < count($totsPublicaciones); $i++) {
                $calculo = ($totsPublicaciones[$i][0]["Total"] * 100) / $totalGeneral;
                array_push($porcentajes, $calculo);
            }
            //Al final
            $objReporte->Porcentajes = $porcentajes;
            return $objReporte;
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function AlertaStock($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_contadorStock(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function MostrarPublicacionPocoStock($id){
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_mostrarPublicacionesConStockMinimo(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function VentasHoy($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_ventasHoy(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function NoValidadas($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_noValidadas(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $noPublicaciones = sizeof($resultado);
            return $noPublicaciones;
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function MostrarNoValidadas($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_mostrarNoValidadas(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function ReporteMensual($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $reporte = ["TotalMesActual" => null, "Porcentaje" => null, "Subio" => 0];
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
            /*             $calculoPorcentaje = ($totalMesActual["Total"] * 100) / $totalMesPasado["Total"];
 */
            $calculoPorcentaje = ($totalMesActual["Total"] * 100) / $totalMesPasado["Total"];


            if ($calculoPorcentaje < 100) {
                $porcentaje = 100 - $calculoPorcentaje;
            } else {
                if ($calculoPorcentaje > 100) {
                    $porcentaje = $calculoPorcentaje - 100;
                    $objReporte->Subio = 1;
                } else {
                    $objReporte->Subio = 3;
                }
            }

            $objReporte->TotalMesActual = $totalMesActual['Total'];
            $objReporte->Porcentaje = round($porcentaje, 2);
            return $objReporte;
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
}
