<?php

class Conexion {

    static public function connectPostgres() {

        try {

            $host="localhost";
            $port="5432";
            $user="postgres";
            $pass="3000REIVAJinf1976";
            $dbname="bdinternacioncnspt";

            $conn = new PDO("pgsql:dbname=$dbname;host=$host;port=$port", $user, $pass); 

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch(PDOException $e) {

            echo "ERROR: " . $e->getMessage();

        }

    }

    static public function connectSQLServer() {

        try {

            $host="172.16.0.74";
            $port="";
            $user="cimfa_10_salud";
            $pass="_Iv8?o%dI^maciUG";
            $dbname="BdHistoriasClinicas";

            //    $conn = new PDO("sqlsrv:Server=192.168.0.17;Database=BdHistoriasClinicas", "sa", "67939058"); 
            $conn = new PDO("sqlsrv:Server=$host;Database=$dbname", "$user", "$pass");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch(PDOException $e) {

            echo "ERROR: " . $e->getMessage();

        }

    }

}