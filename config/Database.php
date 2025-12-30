<?php

// PROTECCION DE ACCESO AL FICHERO
defined("ACCESS_SUCCESS") or header("Location: ../../error-403");

class Database
{

    // METODO PARA EJECUTAR QUERIES
    public function query($sql, $connection, $format, $params = array(), $getLastInsertId = false)
    {
        // VARIABLE PARA LOS DATOS DE CONEXION
        $data_connections = array();

        // INCLUYO LOS DATOS DE LAS DIFERENTES CONEXIONES
        include 'config/connections.php';

        // CONECTO CON LA BASE DE DATOS
        try {

            // CONECTA A LA DB POR PDO Y CONFIGURA LOS ATRIBUTOS.
            $mbd = new PDO('mysql:host=' . $data_connections[$connection]['hostname'] . ';dbname=' . $data_connections[$connection]['database'], $data_connections[$connection]['username'], $data_connections[$connection]['password']);
            $mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $mbd->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
            $mbd->exec("SET CHARACTER SET utf8");

            // PREPARA LA CONSULTA Y EJECUTA CON LOS PARÁMETROS.
            $stmt = $mbd->prepare($sql);
            $stmt->execute($params);

            // SI LA CONSULTA ES UNA INSERCIÓN, OBTENEMOS EL ÚLTIMO ID INSERTADO
            if ($getLastInsertId) {
                $lastInsertId = $mbd->lastInsertId();
                $mbd = null;
                return $lastInsertId;
            }

            // FORMATEA LOS RESULTADOS.
            $data = array();
            if ($format == 'assoc') {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } elseif ($format == 'num') {
                $data = $stmt->fetchAll(PDO::FETCH_NUM);
            } elseif ($format == 'all') {
                $data = $stmt->fetchAll(PDO::FETCH_BOTH);
            }

            // CIERRA CONEXIÓN Y DEVUELVE.
            $mbd = null;
            return $data;
        } catch (PDOException $e) {
            if ($e->getMessage() != "SQLSTATE[HY000]: General error") {
                $mbd = null;
                return "Error: " . $e->getMessage() . "\n\n" . $sql;
                die();
            }
        }
    }
}
