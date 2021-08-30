<?php
session_start();
if ($_SESSION['roles'] == '3') {
    include_once '../../../dao/conexion.php';
    // file header stuff
    $output = "-- PHP MySQL Dump\n--\n";
    $output .= "-- Host: $host\n";
    $output .= "-- Generated: " . date("r", time()) . "\n";
    $output .= "-- PHP Version: " . phpversion() . "\n\n";
    $output .= "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\n\n";
    $output .= "--\n-- Database: `$nombreBD`\n--\n";
    // get all table names in db and stuff them into an array
    $tables = array();
    $stmt = $pdo->query("SHOW TABLES");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }
    // process each table in the db
    foreach ($tables as $table) {
        $fields = "";
        $sep2 = "";
        $output .= "\n-- " . str_repeat("-", 60) . "\n\n";
        $output .= "--\n-- Table structure for table `$table`\n--\n\n";
        // get table create info
        $stmt = $pdo->query("SHOW CREATE TABLE $table");
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $output .= $row[1] . ";\n\n";
        // get table data
        $output .= "--\n-- Dumping data for table `$table`\n--\n\n";
        $stmt = $pdo->query("SELECT * FROM $table");
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            // runs once per table - create the INSERT INTO clause
            if ($fields == "") {
                $fields = "INSERT INTO `$table` (";
                $sep = "";
                // grab each field name
                foreach ($row as $col => $val) {
                    $fields .= $sep . "`$col`";
                    $sep = ", ";
                }
                $fields .= ") VALUES";
                $output .= $fields . "\n";
            }
            // grab table data
            $sep = "";
            $output .= $sep2 . "(";
            foreach ($row as $col => $val) {
                // add slashes to field content
                $val = addslashes($val);
                // replace stuff that needs replacing
                $search = array("\'", "\n", "\r");
                $replace = array("''", "\\n", "\\r");
                $val = str_replace($search, $replace, $val);
                $output .= $sep . "'$val'";
                $sep = ", ";
            }
            // terminate row data
            $output .= ")";
            $sep2 = ",\n";
        }
        // terminate insert data
        $output .= ";\n";
    }
    // output file to browser
    header('Content-Description: File Transfer');
    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $nombreBD . '.sql');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . strlen($output));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    header('Pragma: public');
    echo $output;
} else {
    echo "<script>alert('No puedes acceder a esta página con el rol que tienes');</script>";
    echo "<script> document.location.href='dashboard.php';</script>";
}
